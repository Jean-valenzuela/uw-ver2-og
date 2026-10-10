<?php
require_once __DIR__.'/borrower_portal.php';require_once __DIR__.'/apply_payment.php';
function pm_config($lenderId){
 $path=getenv('UW_PAYMONGO_CONFIG');if(!$path||!is_file($path))throw new DomainException('Online payments are not configured for your lender yet. Please contact your lender.');
 $real=str_replace('\\','/',realpath($path));$root=rtrim(str_replace('\\','/',realpath(__DIR__.'/..')),'/');$doc=rtrim(str_replace('\\','/',realpath($_SERVER['DOCUMENT_ROOT']??'')?:$root),'/');
 if(stripos($real,$root.'/')===0||($doc&&stripos($real,$doc.'/')===0))throw new DomainException('Payment configuration must be stored outside the public website directory.');
 $all=require $path;$c=$all['lenders'][(int)$lenderId]??null;
 if(!$c||empty($c['secret_key'])||empty($c['webhook_secret']))throw new DomainException('Online payments are not configured for your lender yet.');
 $c['live']=($c['mode']??'test')==='live';if(strpos($c['secret_key'],$c['live']?'sk_live_':'sk_test_')!==0)throw new DomainException('Your lender payment configuration needs attention.');
 $c['public_url']=rtrim($all['public_url']??'','/');if(!filter_var($c['public_url'],FILTER_VALIDATE_URL)||parse_url($c['public_url'],PHP_URL_SCHEME)!=='https')throw new DomainException('Online payments require the configured HTTPS website address.');return $c;
}
function pm_http($config,$path,$payload=null){
 $ch=curl_init('https://api.paymongo.com/'.$path);curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_USERPWD=>$config['secret_key'].':',CURLOPT_HTTPAUTH=>CURLAUTH_BASIC,CURLOPT_CONNECTTIMEOUT=>10,CURLOPT_TIMEOUT=>30,CURLOPT_HTTPHEADER=>['Content-Type: application/json','Accept: application/json'],CURLOPT_PROTOCOLS=>CURLPROTO_HTTPS]);
 if($payload!==null){curl_setopt($ch,CURLOPT_POST,true);curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($payload,JSON_THROW_ON_ERROR));}
 $raw=curl_exec($ch);$status=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);
 if($raw===false||$status>=500||$status===0)throw new RuntimeException('Payment provider confirmation is delayed. Check payment history before trying again.');
 if($status<200||$status>=300)throw new DomainException('The payment provider could not accept this request. Ask your lender to check the payment account settings.');
 $data=json_decode($raw,true,512,JSON_THROW_ON_ERROR);if(empty($data['data']))throw new RuntimeException('Payment provider returned an incomplete response.');return $data['data'];
}
function pm_quote($a,$mode,$persist=false){
 if($a['status']!=='active')throw new DomainException('Payments are available after your lender releases the loan.');
 if(!in_array($mode,['regular','interest-only'],true))throw new DomainException('Choose an installment or interest-only payment.');
 $rows=payment_components($a,$persist);$unpaid=array_values(array_filter($rows,fn($r)=>$r['principal_remaining']+$r['interest_remaining']>0));if(!$unpaid)throw new DomainException('This loan is fully paid.');$first=$unpaid[0];$carry=$mode==='interest-only'?interest_only_preview($a,$rows):null;
 $q=['installment_id'=>(int)$first['installment_id'],'amount_cents'=>$carry?$carry['payment_cents']:$first['principal_remaining']+$first['interest_remaining'],'mode'=>$mode,'due_date'=>$first['due_date'],'carry_cents'=>$carry['carry_cents']??0,'added_interest_cents'=>$carry['added_interest_cents']??0,'next_due_date'=>$carry['next_due_date']??null,'next_amount_cents'=>$carry['next_amount_cents']??0];
 $q['fingerprint']=hash('sha256',json_encode(array_map(fn($r)=>[$r['installment_id'],$r['due_date'],$r['principal_remaining'],$r['interest_remaining']],$rows)));return $q;
}
function pm_signature_valid($raw,$header,$config){
 $parts=[];foreach(explode(',',$header) as $part){$v=explode('=',trim($part),2);if(count($v)===2)$parts[$v[0]]=$v[1];}
 $t=$parts['t']??'';$sig=$parts[$config['live']?'li':'te']??'';return ctype_digit($t)&&abs(time()-(int)$t)<=300&&preg_match('/^[a-f0-9]{64}$/D',$sig)&&hash_equals(hash_hmac('sha256',$t.'.'.$raw,$config['webhook_secret']),$sig);
}
// Only call with an authenticated provider response or a verified webhook resource.
function pm_settle($lenderId,$resource){global $conn;
 $s=$resource['attributes']??[];$session=$resource['id']??'';if(($resource['type']??'')!=='checkout_session'||!preg_match('/^cs_[a-zA-Z0-9]+$/D',$session))throw new DomainException('Invalid checkout session.');
 $ref=$s['reference_number']??'';$lookup=db('SELECT * FROM paymongo_orders WHERE lender_id=? AND (session_id=? OR order_id=?)',[$lenderId,$session,$ref])->get_result()->fetch_assoc();if(!$lookup)throw new DomainException('Checkout order not found.');
 $conn->begin_transaction();try{
 $a=db('SELECT * FROM loan_agreements WHERE agreement_id=? FOR UPDATE',[$lookup['agreement_id']])->get_result()->fetch_assoc();$o=db('SELECT * FROM paymongo_orders WHERE order_id=? FOR UPDATE',[$lookup['order_id']])->get_result()->fetch_assoc();
 if(($o['session_id']&&$o['session_id']!==$session)||$ref!==$o['order_id']||!isset($s['livemode'])||(bool)$s['livemode']!==(bool)$o['livemode'])throw new DomainException('Checkout identity mismatch.');
 $payments=array_values(array_filter($s['payments']??[],fn($v)=>($v['attributes']['status']??'')==='paid'));
 if(!$payments){if(($s['status']??'')==='expired'&&in_array($o['state'],['creating','pending','uncertain'],true)){db("UPDATE paymongo_orders SET state='expired',session_id=? WHERE order_id=?",[$session,$o['order_id']]);$conn->commit();return 'expired';}$conn->rollback();return 'pending';}if(count($payments)!==1)throw new DomainException('Unexpected payment count.');$payment=$payments[0];$pa=$payment['attributes'];$pid=$payment['id']??'';
 if(!preg_match('/^pay_[a-zA-Z0-9]+$/D',$pid)||($pa['currency']??'')!=='PHP'||!is_int($pa['amount']??null)||$pa['amount']!==(int)$o['amount_cents']||!isset($pa['livemode'])||(bool)$pa['livemode']!==(bool)$o['livemode'])throw new DomainException('Payment amount, currency or mode mismatch.');
 if($o['state']==='paid'){if($o['provider_payment_id']!==$pid)throw new DomainException('Unexpected second payment.');$conn->commit();return 'paid';}
 if($o['state']==='review'){$conn->commit();return 'review';}
 $method=$pa['source']['type']??'PayMongo';if(!in_array($method,['gcash','card'],true))throw new DomainException('Unexpected payment method.');
 $saved=json_decode($o['quote_json'],true,512,JSON_THROW_ON_ERROR);$valid=true;try{$fresh=pm_quote($a,$o['mode'],true);$valid=$saved===$fresh;}catch(DomainException $e){$valid=false;}
 if(!$valid){db("UPDATE paymongo_orders SET state='review',session_id=?,provider_payment_id=?,method=?,paid_at=NOW(),error_note='Payment received but the loan schedule changed. Lender reconciliation required.' WHERE order_id=?",[$session,$pid,$method,$o['order_id']]);$conn->commit();return 'review';}
 $rows=payment_components($a,true);$q=$o['mode']==='interest-only'?interest_only_preview($a,$rows):null;$paidAt=(int)($pa['paid_at']??time());if($paidAt<1||$paidAt>time()+300)$paidAt=time();
 $paymentId=apply_loan_payment($a,$rows,(int)$o['amount_cents'],$o['mode'],date('Y-m-d',$paidAt),'PayMongo '.$method.' '.$pid,hash('sha256','paymongo:'.$o['order_id']),$o['borrower_id'],$q);
 db("UPDATE paymongo_orders SET state='paid',session_id=?,provider_payment_id=?,payment_id=?,method=?,paid_at=? WHERE order_id=?",[$session,$pid,$paymentId,$method,date('Y-m-d H:i:s',$paidAt),$o['order_id']]);
 if($q)db("INSERT INTO extension_requests(agreement_id,borrower_id,lender_id,installment_id,original_due_date,requested_due_date,reason,status,review_reason,reviewed_at) VALUES (?,?,?,?,?,?,?,'approved',?,NOW())",[$a['agreement_id'],$a['borrower_id'],$a['lender_id'],$q['from']['installment_id'],$q['from']['due_date'],$q['next_due_date'],'Borrower paid monthly interest and accepted the displayed principal carry.','Automatically completed after verified payment; principal carried without a penalty.']);
 $conn->commit();return 'paid';
 }catch(Throwable $e){$conn->rollback();throw $e;}
}

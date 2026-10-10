<?php
require_once __DIR__.'/lender_records.php';require_once __DIR__.'/payment_records.php';
function lender_dashboard_data($lenderId,$year){
 $loans=lender_loans($lenderId);$totals=['lent'=>0,'paid'=>0,'overdue'=>0,'interest'=>0,'legacy_interest'=>0,'loaners'=>0];$summary=[];$undatedLent=0;$unclassifiedInterestPayments=0;
 foreach($loans as $a){
  if($a['status']==='draft')continue;
  $totals['lent']+=cents($a['principal']);$totals['paid']+=cents($a['amount_paid']);
  try{foreach(payment_components($a) as $i){$totals['interest']+=cents($i['interest_paid'])+cents($i['legacy_interest_paid']);$totals['legacy_interest']+=cents($i['legacy_interest_paid']);}}catch(DomainException $e){$unclassifiedInterestPayments+=cents($a['amount_paid']);}
  if(!$a['released_at'])$undatedLent+=cents($a['principal']);
  $summary[]=$a;
 }
 $overdue=db("SELECT COALESCE(SUM(i.amount_due-i.amount_paid),0) amount,COUNT(DISTINCT a.borrower_id) borrowers FROM loan_installments i JOIN loan_agreements a ON a.agreement_id=i.agreement_id WHERE a.lender_id=? AND a.status='active' AND i.due_date<CURDATE() AND i.amount_due>i.amount_paid",[$lenderId])->get_result()->fetch_assoc();$totals['overdue']=cents($overdue['amount']);
 $totals['loaners']=(int)db("SELECT COUNT(*) n FROM users WHERE user_type_id=2 AND selected_lender_id=? AND account_status='approved'",[$lenderId])->get_result()->fetch_assoc()['n'];
 $pending=(int)db("SELECT COUNT(*) n FROM users WHERE user_type_id=2 AND selected_lender_id=? AND account_status='pending'",[$lenderId])->get_result()->fetch_assoc()['n'];
 $extensions=(int)db("SELECT COUNT(*) n FROM extension_requests WHERE lender_id=? AND status='pending'",[$lenderId])->get_result()->fetch_assoc()['n'];
 $dueSoon=(int)db("SELECT COUNT(DISTINCT a.borrower_id) n FROM loan_installments i JOIN loan_agreements a ON a.agreement_id=i.agreement_id WHERE a.lender_id=? AND a.status='active' AND i.amount_due>i.amount_paid AND i.due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 7 DAY)",[$lenderId])->get_result()->fetch_assoc()['n'];
 $upcoming=lender_rows("SELECT i.installment_id,i.installment_number,i.due_date,i.amount_due-i.amount_paid balance,a.agreement_id,u.user_fn,u.user_ln FROM loan_installments i JOIN loan_agreements a ON a.agreement_id=i.agreement_id JOIN users u ON u.user_id=a.borrower_id WHERE a.lender_id=? AND a.status='active' AND i.amount_due>i.amount_paid AND i.due_date>=CURDATE() ORDER BY i.due_date,i.installment_id LIMIT 12",[$lenderId]);
 $months=[];for($m=1;$m<=12;$m++)$months[$m]=['month'=>date('M',mktime(0,0,0,$m,1,$year)),'lent'=>0,'paid'=>0];
 $start=$year.'-01-01';$end=($year+1).'-01-01';
 foreach(lender_rows("SELECT MONTH(c.released_at) month,SUM(a.principal) amount FROM loan_agreements a JOIN lender_contracts c ON c.agreement_id=a.agreement_id WHERE a.lender_id=? AND a.status<>'draft' AND c.released_at>=? AND c.released_at<? GROUP BY MONTH(c.released_at)",[$lenderId,$start,$end]) as $row)$months[(int)$row['month']]['lent']=cents($row['amount']);
 foreach(lender_rows('SELECT MONTH(p.payment_date) month,SUM(p.amount) amount FROM loan_payments p JOIN loan_agreements a ON a.agreement_id=p.agreement_id WHERE a.lender_id=? AND p.payment_date>=? AND p.payment_date<? GROUP BY MONTH(p.payment_date)',[$lenderId,$start,$end]) as $row)$months[(int)$row['month']]['paid']=cents($row['amount']);
 $recorded=cents(db('SELECT COALESCE(SUM(p.amount),0) n FROM loan_payments p JOIN loan_agreements a ON a.agreement_id=p.agreement_id WHERE a.lender_id=?',[$lenderId])->get_result()->fetch_assoc()['n']);
 return compact('totals','summary','upcoming','months','pending','extensions','dueSoon','overdue','undatedLent','recorded','unclassifiedInterestPayments');
}
function lender_event_rows($lenderId){
 return lender_rows("SELECT 'application' kind,u.user_id id,u.user_fn,u.user_ln,s.submitted_at happened_at,0 amount,u.account_status state FROM users u LEFT JOIN borrower_submissions s ON s.user_id=u.user_id WHERE u.selected_lender_id=? AND u.user_type_id=2 AND u.account_status<>'incomplete'
 UNION ALL SELECT 'payment',p.payment_id,u.user_fn,u.user_ln,p.created_at,p.amount,a.status FROM loan_payments p JOIN loan_agreements a ON a.agreement_id=p.agreement_id JOIN users u ON u.user_id=a.borrower_id WHERE a.lender_id=?
 UNION ALL SELECT 'extension',r.request_id,u.user_fn,u.user_ln,r.requested_at,0,r.status FROM extension_requests r JOIN users u ON u.user_id=r.borrower_id WHERE r.lender_id=? UNION ALL SELECT 'loan-request',r.request_id,u.user_fn,u.user_ln,r.created_at,r.amount,r.status FROM borrower_loan_requests r JOIN users u ON u.user_id=r.borrower_id WHERE r.lender_id=? ORDER BY happened_at DESC,id DESC",[$lenderId,$lenderId,$lenderId,$lenderId]);
}
function lender_notifications($lenderId){
 $read=[];foreach(lender_rows('SELECT event_type,event_id FROM lender_notification_reads WHERE lender_id=?',[$lenderId]) as $r)$read[$r['event_type'].'-'.$r['event_id']]=true;
 $items=[];$count=0;foreach(lender_event_rows($lenderId) as $e){if(isset($read[$e['kind'].'-'.$e['id']]))continue;$count++;if(count($items)<30)$items[]=$e;}
 return ['count'=>$count,'items'=>$items];
}

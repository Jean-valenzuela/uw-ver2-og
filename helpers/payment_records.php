<?php
require_once __DIR__.'/lending.php';
function cents($value){return (int)round((float)$value*100);}
function payment_components($agreement,$persist=false){
 $rows=lender_rows('SELECT i.*,c.principal_due,c.interest_due,c.legacy_principal_paid,c.legacy_interest_paid,COALESCE(p.principal_paid,0) AS principal_paid,COALESCE(p.interest_paid,0) AS interest_paid FROM loan_installments i LEFT JOIN loan_schedule_components c ON c.installment_id=i.installment_id LEFT JOIN (SELECT installment_id,SUM(principal_amount) principal_paid,SUM(interest_amount) interest_paid FROM lender_payment_allocations GROUP BY installment_id) p ON p.installment_id=i.installment_id WHERE i.agreement_id=? ORDER BY i.installment_number',[$agreement['agreement_id']]);
 foreach($rows as &$i){
  if($i['principal_due']===null){
   $n=(int)$agreement['term_months'];$interest=intdiv(cents($agreement['total_interest']),max($n,1));
   if((int)$i['installment_number']===$n)$interest=cents($agreement['total_interest'])-$interest*($n-1);
   if(count($rows)!==$n||$interest>cents($i['amount_due']))throw new DomainException('This historical schedule needs its principal and interest breakdown reviewed before recording another payment.');
   $principal=cents($i['amount_due'])-$interest;$paid=min(cents($i['amount_paid']),cents($i['amount_due']));
   $legacyInterest=cents($i['amount_due'])?min($interest,(int)round($paid*$interest/cents($i['amount_due']))):0;
   $i['principal_due']=$principal/100;$i['interest_due']=$interest/100;$i['legacy_principal_paid']=($paid-$legacyInterest)/100;$i['legacy_interest_paid']=$legacyInterest/100;
   if($persist)db('INSERT INTO loan_schedule_components(installment_id,principal_due,interest_due,legacy_principal_paid,legacy_interest_paid) VALUES (?,?,?,?,?)',[$i['installment_id'],$i['principal_due'],$i['interest_due'],$i['legacy_principal_paid'],$i['legacy_interest_paid']]);
  }
  $i['principal_remaining']=max(0,cents($i['principal_due'])-cents($i['principal_paid'])-cents($i['legacy_principal_paid']));
  $i['interest_remaining']=max(0,cents($i['interest_due'])-cents($i['interest_paid'])-cents($i['legacy_interest_paid']));
 }unset($i);return $rows;
}
function interest_only_preview($a,$rows){
 $unpaid=array_values(array_filter($rows,fn($i)=>$i['principal_remaining']+$i['interest_remaining']>0));
 if(!$unpaid)throw new DomainException('This loan is fully paid.');$from=$unpaid[0];
 if(!$from['principal_remaining']||!$from['interest_remaining'])throw new DomainException('Interest-only carry requires both unpaid monthly interest and principal. Use a regular payment or an extension request.');
 $next=null;foreach($rows as $i)if((int)$i['installment_number']>(int)$from['installment_number']){$next=$i;break;}
 $added=$next?0:(int)round(cents($a['principal'])*(float)$a['monthly_interest_percent']/100);
 $nextDue=$next?$next['due_date']:monthly_due_date($from['due_date'],1);
 $nextBalance=$next?$next['principal_remaining']+$next['interest_remaining']:$added;
 return ['from'=>$from,'next'=>$next,'payment_cents'=>$from['interest_remaining'],'carry_cents'=>$from['principal_remaining'],'added_interest_cents'=>$added,'next_due_date'=>$nextDue,'next_amount_cents'=>$nextBalance+$from['principal_remaining']];
}

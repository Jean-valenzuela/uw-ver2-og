<?php
require_once __DIR__.'/../ajax/app.php';
header('Cache-Control: no-store, private');

function lender_user() {
    $u = require_user(1);
    if ($u['account_status'] !== 'approved') { http_response_code(403); exit('An approved lender account is required.'); }
    return $u;
}
function lender_borrower($id, $lenderId, $lock = false) {
    $u = db("SELECT * FROM users WHERE user_id=? AND user_type_id=2 AND selected_lender_id=?".($lock?' FOR UPDATE':''),[$id,$lenderId])->get_result()->fetch_assoc();
    if (!$u) throw new DomainException('Borrower not found for this lender.');
    return $u;
}
function money($amount) { return 'PHP '.number_format((float)$amount,2); }
function lender_date($value) {
    $date=DateTimeImmutable::createFromFormat('!Y-m-d',$value);
    if (!$date || $date->format('Y-m-d')!==$value) throw new DomainException('Please enter a valid date.');
    return $date;
}
function amount_cents($value) {
    if (!preg_match('/^\d{1,7}(\.\d{1,2})?$/D',(string)$value)) throw new DomainException('Enter a valid amount with at most two decimal places.');
    return (int)round((float)$value*100);
}
function monthly_due_date($first, $offset) {
    $date=lender_date($first);
    $month=$date->modify('first day of this month')->modify('+'.$offset.' months');
    return $month->setDate((int)$month->format('Y'),(int)$month->format('m'),min((int)$date->format('d'),(int)$month->format('t')))->format('Y-m-d');
}
function contract_quote($input) {
    $principal=amount_cents($input['principal']??'');
    if ($principal<100 || $principal>100000000) throw new DomainException('Principal must be between PHP 1 and PHP 1,000,000.');
    $rate=trim($input['monthly_interest_percent']??'');
    if (!preg_match('/^\d{1,3}(\.\d{1,4})?$/D',$rate) || (float)$rate>100) throw new DomainException('Enter a monthly interest percentage from 0 to 100, with up to four decimal places.');
    $term=filter_var($input['term_months']??null,FILTER_VALIDATE_INT);
    if (!in_array($term,[3,6,12],true)) throw new DomainException('Select 3, 6 or 12 monthly installments.');
    $release=lender_date($input['release_date']??'');
    $first=lender_date($input['first_due_date']??'');
    if ($first <= $release || $first > $release->modify('+2 months')) throw new DomainException('The first due date must be after release and within two months.');
    $purpose=trim($input['purpose']??'');
    if ($purpose==='' || mb_strlen($purpose)>1000) throw new DomainException('Enter a loan purpose of up to 1,000 characters.');
    $interest=(int)round($principal*(float)$rate*$term/100,0,PHP_ROUND_HALF_UP);
    $total=$principal+$interest;
    $regular=intdiv($total,$term);
    $schedule=[];
    for($i=0;$i<$term;$i++) $schedule[]=['number'=>$i+1,'due_date'=>monthly_due_date($first->format('Y-m-d'),$i),'cents'=>$i===$term-1?$total-$regular*($term-1):$regular];
    return ['principal_cents'=>$principal,'rate'=>$rate,'term'=>$term,'interest_cents'=>$interest,'total_cents'=>$total,'regular_cents'=>$regular,'monthly_interest_cents'=>$principal*(float)$rate/100,'release_date'=>$release->format('Y-m-d'),'first_due_date'=>$first->format('Y-m-d'),'purpose'=>$purpose,'schedule'=>$schedule];
}
function lender_json($data,$status=200) { http_response_code($status); header('Content-Type: application/json; charset=utf-8'); echo json_encode($data,JSON_THROW_ON_ERROR); exit; }
function lender_post() { if($_SERVER['REQUEST_METHOD']!=='POST'){header('Allow: POST');lender_json(['error'=>'POST required.'],405);} check_csrf(); }
function lender_rows($sql,$values=[]) { return db($sql,$values)->get_result()->fetch_all(MYSQLI_ASSOC); }
function queue_lender_email($event,$borrower,$lenderId,$subject,$body,$agreementId=null) {
    db('INSERT INTO lender_outbox(event_key,borrower_id,lender_id,agreement_id,recipient,subject,body,message_id) VALUES(?,?,?,?,?,?,?,?)',[$event,$borrower['user_id'],$lenderId,$agreementId,$borrower['email'],$subject,$body,'<'.bin2hex(random_bytes(20)).'@utangwise.local>']);
    global $conn; return $conn->insert_id;
}

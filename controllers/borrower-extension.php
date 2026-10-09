<?php
require __DIR__.'/../ajax/borrower.php';
require __DIR__.'/../helpers/lending.php';
$borrower=borrower_user();
if($_SERVER['REQUEST_METHOD']!=='POST')go('borrower/payment-extension.php');
check_csrf();
try {
    $id=(int)($_POST['installment_id']??0);
    $lookup=db('SELECT agreement_id FROM loan_installments WHERE installment_id=?',[$id])->get_result()->fetch_assoc();
    if(!$lookup)throw new DomainException('Installment not found.');
    $conn->begin_transaction();
    $loan=db("SELECT * FROM loan_agreements WHERE agreement_id=? AND borrower_id=? AND status='active' FOR UPDATE",[$lookup['agreement_id'],$borrower['user_id']])->get_result()->fetch_assoc();
    if(!$loan)throw new DomainException('Select an active loan belonging to your account.');
    $item=db('SELECT * FROM loan_installments WHERE installment_id=? AND amount_paid<amount_due FOR UPDATE',[$id])->get_result()->fetch_assoc();
    if(!$item)throw new DomainException('This installment is already paid.');
    if(db("SELECT request_id FROM extension_requests WHERE agreement_id=? AND status='pending'",[$loan['agreement_id']])->get_result()->num_rows)throw new DomainException('This loan already has an extension awaiting review.');
    $new=lender_date($_POST['requested_due_date']??'');$old=lender_date($item['due_date']);
    $days=(int)$old->diff($new)->format('%r%a');
    if($days<1||$days>365||$new<new DateTimeImmutable('today'))throw new DomainException('Choose a date after the current due date, not in the past, and no more than 365 days later.');
    $reason=trim($_POST['reason']??'');if(mb_strlen($reason)<5||mb_strlen($reason)>2000)throw new DomainException('Provide a reason of 5–2,000 characters.');
    db('INSERT INTO extension_requests(agreement_id,borrower_id,lender_id,installment_id,original_due_date,requested_due_date,reason) VALUES(?,?,?,?,?,?,?)',[$loan['agreement_id'],$borrower['user_id'],$loan['lender_id'],$id,$item['due_date'],$new->format('Y-m-d'),$reason]);
    $conn->commit();$_SESSION['notice']='Your extension request was submitted to your lender.';
}catch(DomainException $e){rollback_safely();$_SESSION['notice']=$e->getMessage();}catch(Throwable $e){rollback_safely();error_log($e->getMessage());$_SESSION['notice']='The request could not be saved. Please try again.';}
go('borrower/payment-extension.php');

<?php
require __DIR__.'/app.php';if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed');}$u=require_user(2);check_csrf();
if($u['account_status']!=='incomplete') go(destination($u));
$data=profile($u['user_id']);
foreach(['idverification','personal-details','financial-details','reference-person','loan-preferences'] as $step) if(empty($data[$step])) fail_form('Complete all profiling steps before submitting.','borrower/new-acc-profiling/verifyacc.php');
if(empty($data['loan-preferences']['loan_purpose']) || empty($data['loan-preferences']['loan_term'])) fail_form('Select your loan purpose and repayment term.','borrower/new-acc-profiling/loan-preferences.php');
if(!document_exists($u['user_id'],'valid_id')) fail_form('Upload your valid ID.','borrower/new-acc-profiling/idverification.php');
$dob=DateTimeImmutable::createFromFormat('!Y-m-d',$data['personal-details']['birth_date']??'');
if(!$dob || $dob->diff(new DateTimeImmutable('today'))->y<21) fail_form('Applicant must be 21 or older.','borrower/new-acc-profiling/personal-details.php');
db("UPDATE users SET account_status='pending' WHERE user_id=? AND account_status='incomplete'",[$u['user_id']]);
$_SESSION['notice']='Application submitted. Your lender will review your account.';
go('public/status.php');

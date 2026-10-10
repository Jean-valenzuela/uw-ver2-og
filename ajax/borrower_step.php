<?php
require __DIR__.'/app.php';
$u=require_user(2);
if ($u['account_status'] !== 'incomplete') go(destination($u));
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {http_response_code(405);exit('Method not allowed');}
$step=basename($_POST['step']??'');
$next=['idverification'=>'personal-details','personal-details'=>'financial-details','financial-details'=>'reference-person','reference-person'=>'loan-preferences','loan-preferences'=>'ready-for-review'];
if (!isset($next[$step])) {http_response_code(400);exit('Invalid step');}
check_csrf();
try {
 $data=profile($u['user_id']);
 $fields=$_POST;unset($fields['csrf'],$fields['step']);
 if ($step==='personal-details') {
  $dob=DateTimeImmutable::createFromFormat('!Y-m-d',$fields['birth_date']??'');
  if (!$dob || $dob->format('Y-m-d')!==($fields['birth_date']??'') || $dob->diff(new DateTimeImmutable('today'))->y<21 || $dob>new DateTimeImmutable('today')) throw new RuntimeException('Applicant must be at least 21 years old.');
  $mobile=preg_replace('/\D/','',$fields['mobile']??'');
  if (str_starts_with($mobile,'63')) $mobile=substr($mobile,2);
  if (str_starts_with($mobile,'0')) $mobile=substr($mobile,1);
  if (!preg_match('/^9\d{9}$/',$mobile)) throw new RuntimeException('Enter 10 mobile digits starting with 9.');
  $fields['mobile']='+63'.$mobile;
  foreach (['first_name','last_name','street','region','province','city','zip_code'] as $key) if (trim($fields[$key]??'')==='') throw new RuntimeException('Please complete '.$key.'.');
 }
 if ($step==='personal-details' && !filter_var($fields['email']??'',FILTER_VALIDATE_EMAIL)) throw new RuntimeException('Enter a valid email address.');
 if ($step==='financial-details') {
   foreach(['gross_income','other_income','expenses'] as $money) if(isset($fields[$money]) && trim($fields[$money])!=='' && (!is_numeric($fields[$money]) || (float)$fields[$money]<0)) throw new RuntimeException('Invalid amount for '.$money);
   if(($fields['has_other_income']??'no')==='no') {$fields['other_income']='';$fields['income_source']='';}
 }
 if ($step==='idverification') upload_document($u['user_id'],'valid_id',true);
 if ($step==='financial-details') upload_document($u['user_id'],'coe',false);
 if ($step==='loan-preferences' && (!preg_match('/^\d+(\.\d{1,2})?$/D',(string)($fields['loan_amount']??'')) || !in_array((float)$fields['loan_amount'],[3000.0,5000.0,10000.0,15000.0],true))) throw new RuntimeException('Choose a loan amount of PHP 3,000, 5,000, 10,000, or 15,000.');
 $data[$step]=$fields;
 db('INSERT INTO application_profiles (user_id,details) VALUES (?,?) ON DUPLICATE KEY UPDATE details=VALUES(details)',[$u['user_id'],json_encode($data,JSON_THROW_ON_ERROR)]);
 go('borrower/new-acc-profiling/'.$next[$step].'.php');
} catch(Throwable $ex){fail_form($ex->getMessage(),'borrower/new-acc-profiling/'.$step.'.php');}

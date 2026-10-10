<?php
require_once __DIR__.'/app.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Allow: POST');http_response_code(405);exit('POST required.');}check_csrf();
if(current_user())go(destination(current_user()));
if(($_POST['account_type']??'')!=='lender')fail_form('Choose a valid account type.','register.php');
$first=trim($_POST['user_fn']??'');$last=trim($_POST['user_ln']??'');$email=strtolower(trim($_POST['email']??''));
$phone=preg_replace('/^(?:\+63|0)/','',trim($_POST['phone']??''));$password=$_POST['password']??'';
if(!$first||!$last||strlen($first)>255||strlen($last)>255||strlen($email)>255||!filter_var($email,FILTER_VALIDATE_EMAIL))fail_form('Enter your name and a valid email.','register.php');
if(!preg_match('/^9[0-9]{9}$/D',$phone))fail_form('Enter 10 mobile digits starting with 9 after +63.','register.php');
if(strlen($password)<8||strlen($password)>72||$password!==($_POST['confirm-password']??''))fail_form('Use matching passwords of 8 to 72 characters.','register.php');
if(empty($_POST['terms']))fail_form('Accept the registration terms.','register.php');
try{
 db("INSERT INTO users(user_type_id,user_fn,user_ln,email,phone,password_hash,account_status) VALUES (1,?,?,?,?,?,'incomplete')",[$first,$last,$email,'0'.$phone,password_hash($password,PASSWORD_DEFAULT)]);
 $_SESSION['uid']=$conn->insert_id;session_regenerate_id(true);$_SESSION['csrf']=bin2hex(random_bytes(32));$_SESSION['uw_success']=['title'=>'Account created','text'=>'Complete your profile and requirements to submit your application for review.'];go('lender/new-acc-profiling/requirements.php');
}catch(mysqli_sql_exception $e){fail_form($e->getCode()===1062?'This email is already registered.':'Registration could not be saved.','register.php');}

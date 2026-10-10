<?php
require __DIR__.'/../helpers/password_reset.php';
if($_SERVER['REQUEST_METHOD']!=='POST')go('forgot-password.php');
check_csrf();
$action=$_POST['action']??'request';
if($action==='request'){
 $email=strtolower(trim($_POST['email']??''));
 if(strlen($email)>255||!filter_var($email,FILTER_VALIDATE_EMAIL))fail_form('Enter a valid email address.','forgot-password.php','email');
 try{
  $conn->begin_transaction();
  $emailAllowed=reset_limit(hash('sha256','email:'.$email),3);$ipAllowed=reset_limit(hash('sha256','ip:'.($_SERVER['REMOTE_ADDR']??'')),20);
  $user=$emailAllowed&&$ipAllowed?db('SELECT user_id,user_fn,email FROM users WHERE email=? FOR UPDATE',[$email])->get_result()->fetch_assoc():null;
  $token=null;
  if($user){$token=bin2hex(random_bytes(32));db('UPDATE password_reset_tokens SET used_at=NOW() WHERE user_id=? AND used_at IS NULL',[$user['user_id']]);db('INSERT INTO password_reset_tokens(token_hash,user_id,expires_at) VALUES (?,?,DATE_ADD(NOW(),INTERVAL 30 MINUTE))',[hash('sha256',$token),$user['user_id']]);}
  $conn->commit();
  if($user&&$token){$status=reset_send($user,$token);db('UPDATE password_reset_tokens SET delivery_status=? WHERE token_hash=?',[$status,hash('sha256',$token)]);}
  $_SESSION['uw_success']=['title'=>'Reset request received','text'=>'If this email is registered, a reset link will be sent. Check your inbox and spam folder. Contact your administrator if it does not arrive.'];go('forgot-password.php');
 }catch(Throwable $error){rollback_safely();error_log('Utang Wise password reset request failed.');fail_form('The reset request could not be completed. Please try again.','forgot-password.php');}
}
if($action!=='reset'){http_response_code(400);exit('Invalid action.');}
$token=$_POST['token']??'';$password=$_POST['password']??'';
$back='reset-password.php?token='.rawurlencode($token);
if(strlen($password)<8||strlen($password)>72)fail_form('Use a password of 8 to 72 bytes.',$back,'password');
if($password!==($_POST['confirm-password']??''))fail_form('The passwords do not match.',$back,'confirm-password');
try{
 $conn->begin_transaction();$row=reset_token($token,true);
 if(!$row)throw new DomainException('This reset link has expired or was already used. Request a new link.');
 db('UPDATE users SET password_hash=? WHERE user_id=?',[password_hash($password,PASSWORD_DEFAULT),$row['user_id']]);
 db('INSERT INTO account_security(user_id,auth_version) VALUES (?,1) ON DUPLICATE KEY UPDATE auth_version=auth_version+1',[$row['user_id']]);
 db('UPDATE password_reset_tokens SET used_at=NOW() WHERE user_id=? AND used_at IS NULL',[$row['user_id']]);$conn->commit();
 unset($_SESSION['uid'],$_SESSION['auth_version']);session_regenerate_id(true);$_SESSION['csrf']=bin2hex(random_bytes(32));
 $_SESSION['uw_success']=['title'=>'Password changed','text'=>'Sign in with your new password.'];go('login.php');
}catch(Throwable $error){rollback_safely();fail_form($error instanceof DomainException?$error->getMessage():'Your password could not be changed. Please try again.',$back);}

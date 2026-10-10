<?php
require __DIR__.'/../helpers/lending.php';
$u=lender_user();
if($_SERVER['REQUEST_METHOD']!=='POST')go('lender/settings.php');
check_csrf();
try{
    $conn->begin_transaction();
    $u=db('SELECT * FROM users WHERE user_id=? FOR UPDATE',[$u['user_id']])->get_result()->fetch_assoc();
    if($u['account_status']!=='approved')throw new DomainException('An approved lender account is required.');
    $first=trim($_POST['user_fn']??'');$last=trim($_POST['user_ln']??'');$email=strtolower(trim($_POST['email']??''));$phone=trim($_POST['phone']??'');
    foreach(['user_fn'=>$first,'user_ln'=>$last] as $key=>$value)if($value===''||strlen($value)>255)throw new DomainException(uw_field_message($key,'Enter a name of up to 255 characters.'));
    if(strlen($email)>255||!filter_var($email,FILTER_VALIDATE_EMAIL))throw new DomainException(uw_field_message('email','Enter a valid email address.'));
    if(!preg_match('/^9[0-9]{9}$/D',$phone))throw new DomainException(uw_field_message('phone','Enter 10 mobile digits starting with 9.'));
    if(!password_verify($_POST['current_password']??'',$u['password_hash']))throw new DomainException(uw_field_message('current_password','The current password is incorrect.'));
    $new=$_POST['new_password']??'';$confirm=$_POST['confirm_new_password']??'';
    if($new!==''&&(strlen($new)<8||strlen($new)>72))throw new DomainException(uw_field_message('new_password','Use 8 to 72 bytes for the new password.'));
    if($new!==$confirm)throw new DomainException(uw_field_message('confirm_new_password','The new passwords do not match.'));
    db('UPDATE users SET user_fn=?,user_ln=?,email=?,phone=?,password_hash=? WHERE user_id=?',[$first,$last,$email,'0'.$phone,$new!==''?password_hash($new,PASSWORD_DEFAULT):$u['password_hash'],$u['user_id']]);
    if($new!==''){db('INSERT INTO account_security(user_id,auth_version) VALUES (?,1) ON DUPLICATE KEY UPDATE auth_version=auth_version+1',[$u['user_id']]);}
    $version=(int)(db('SELECT auth_version FROM account_security WHERE user_id=?',[$u['user_id']])->get_result()->fetch_assoc()['auth_version']??0);
    $conn->commit();$_SESSION['auth_version']=$version;session_regenerate_id(true);$_SESSION['csrf']=bin2hex(random_bytes(32));
    $_SESSION['uw_success']=['title'=>'Settings saved','text'=>'Your profile and sign-in details have been updated.'];go('lender/settings.php');
}catch(Throwable $error){
    rollback_safely();
    if($error instanceof mysqli_sql_exception&&$error->getCode()===1062)fail_form('This email is already registered.','lender/settings.php','email');
    fail_form($error instanceof DomainException?$error->getMessage():'Your settings could not be saved. Please try again.','lender/settings.php');
}

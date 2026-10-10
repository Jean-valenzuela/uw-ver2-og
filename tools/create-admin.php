<?php
// Run locally in a terminal. This command never updates an existing account.
if(PHP_SAPI!=='cli'){http_response_code(404);exit;}
$_SERVER['DOCUMENT_ROOT']=dirname(__DIR__,2);
require __DIR__.'/../ajax/app.php';
$email=strtolower(trim(getenv('UW_INITIAL_ADMIN_EMAIL')?:''));
$password=getenv('UW_INITIAL_ADMIN_PASSWORD')?:'';
$name=trim(getenv('UW_INITIAL_ADMIN_NAME')?:'Administrator');
if(!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($email)>255||strlen($password)<12||strlen($password)>72||$name===''||strlen($name)>255){fwrite(STDERR,"Set UW_INITIAL_ADMIN_EMAIL, UW_INITIAL_ADMIN_NAME and UW_INITIAL_ADMIN_PASSWORD (12–72 bytes), then run again.\n");exit(1);}
try{
    db("INSERT INTO users(user_type_id,user_fn,user_ln,email,phone,password_hash,account_status) VALUES(3,?,'',?,'',?,'approved')",[$name,$email,password_hash($password,PASSWORD_DEFAULT)]);
    echo "Administrator created. Sign in through admin/login.php. Clear the temporary password environment variable.\n";
}catch(mysqli_sql_exception $error){fwrite(STDERR,$error->getCode()===1062?"That email already exists. No account was changed.\n":"Could not create the administrator. Check the database configuration.\n");exit(1);}

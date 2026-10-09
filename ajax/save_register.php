<?php

require_once 'config.php';

$fname=$_POST['user_fn'];
$lname=$_POST['user_ln'];
$eml=$_POST['email'];
$phnum=$_POST['phone'];
$pass=$_POST['password'];


$stmt=$conn->prepare("INSERT INTO uw-ver2 (user_fn, user_ln, email, phone, password) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss",$fname, $lname, $eml, $phnum, $pass);
if($stmt->execute()){
    echo "success";

}else{
    echo "error";
}

?>
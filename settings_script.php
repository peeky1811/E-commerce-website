<?php

require 'includes/common.php';
//if user is not logged in
if(!isset($_SESSION['email'])){
    header('location:index.php');
}

$email=$_SESSION['email'];
$oldpass= mysqli_real_escape_string($con, $_POST['old-password']);
$oldpass= md5($oldpass);

$newpass= mysqli_real_escape_string($_POST['new-password']);
$newpass= md5($newpass);

$retypepass= mysqli_real_escape_string($_POST['retype-password']);
$retypepass= md5($retypepass);

$query="SELECT email, password FROM users WHERE email='$email'";
$result= mysqli_query($con, $query) or die(mysqli_error($con));

$row= mysqli_fetch_array($result);
$originalpass=$row['password'];

if($newpass!=$retypepass){
    header('location:settings.php?error=The two passwords do not match.');
}
else if($oldpass==$originalpass){
    $query="UPDATE users SET password='$newpass' WHERE email='$email'";
    mysqli_query($con,$query) or die(mysqli_error($con));
    header('location:setting.php?error=Password Updated');
}
 else {
    header('location:settings.php?error=Old password is wrong.');
}
?>
<?php

require 'includes/common.php';
$email=$_POST['email'];
$regex_email="/^[_a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if(!preg_match($regex_email, $email)){
    header('location:signup.php?email_error=Enter correct email');
}
$password=$_POST['password'];
if(strlen($password)<6){
    header('location:signup.php?password_error=Enter correct password');
}
$email= mysqli_real_escape_string($con, $email);
$password= mysqli_real_escape_string($con, md5($password));
$name= mysqli_real_escape_string($con, $_POST['name']);
$contact= mysqli_real_escape_string($con, $_POST['contact']);
$city= mysqli_real_escape_string($con, $_POST['city']);
$address= mysqli_real_escape_string($con, $_POST['address']);

$dupli_query="SELECT id FROM store.users WHERE email='$email'";
$dupli_result= mysqli_query($con, $dupli_query) or die(mysqli_error($con));
if(mysqli_num_rows($dupli_result)>0){
    echo 'This email id already exists.';
}
else{
    $insert_query="INSERT INTO store.users(name,email, password, contact, city, address) VALUES('$name','$email','$password', '$contact','$city', '$address')";
    $insert_result= mysqli_query($con, $insert_query) or die(mysqli_error($con));
    echo 'user successfully inserted';
    $_SESSION['user_id']= mysqli_insert_id($con);
    //Redirect the user to products.php page using header function.
    if(isset($_SESSION['user_id'])){
        header('location:products.php');
        
    }
}

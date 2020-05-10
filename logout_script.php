<?php

session_start();
//if user is not logged in
if(!isset($_SESSION['email'])){
    header('location:index.php');
}
//if user is logged in
session_destroy();
header('location:index.php');

?>
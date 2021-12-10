<?php 
session_start();
require_once 'Logic/Authent_Logic.php';
require_once 'Logic/Validation/Special_Val.php';

if(!isset($_POST['user']) || isset($_SESSION['user'])) header('Location:index.php');

if(!Special::login_val($_POST['user'])) header('Location:index.php');

$act = Authent_Logic::user_login($_POST['user']);

if($act['check']){
    echo 'login成功';
    // header('Location:index.php');
}else{
    header('Location:login_failed.php');
}

?>
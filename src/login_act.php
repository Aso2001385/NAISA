<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Validation/Special_Val.php';

if(!isset($_POST['user']) || isset($_SESSION['user'])) header('Location:index.php');

if(!Special::login_val($_POST['user'])) header('Location:index.php');

$act = Authent_Logic::user_login($_POST['user']);

if($act['check']){
    header('Location:index.php');
}else{
    header('Location:login_failed.php');
}

?>
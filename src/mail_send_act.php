<?php
session_start();

if(isset($_SESSION['user']) || !isset($_SESSION['tmp_user'])){
    header('Location:index.php');
    exit();
}

require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

$mail = $_SESSION['tmp_user']['mail'];
$name = $_SESSION['tmp_user']['nick_name'];

if(Authent_Logic::confirm_code_send($mail,$name)){
    header('Location:mail_confirm.php');
    exit();
}else{
    header('Location:index.php');
    exit();
}


?>
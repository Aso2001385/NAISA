<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

try{

    if(!isset($_SESSION['user']) || !isset($_POST['user'])){
        header('Location:index.php');
        exit();
    }
    
    $act = Authent_Logic::user_edit($_POST['user'],$_SESSION['user']['id']);
    if(!$act['check']){
        header('Location:user_edit_complete.php?mode=0');
    }

    header('Location:user_edit_complete.php?mode=1');
    exit();

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:user_edit_complete.php?mode=2");
    exit();
}


?>
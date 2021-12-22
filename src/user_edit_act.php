<?php 
session_start();
require_once 'Logic/Authent_Logic.php';

try{

    if(!isset($_SESSION['user']) || !isset($_POST['user'])) header('Location:index.php');

    /* ユーザー更新処理 */
    $act = Authent_Logic::user_edit($_POST['user'],$_SESSION['user']['id']);
    if(!$act['check']){
        header('Location:user_edit_complete.php?mode=0');
    }

    header('Location:user_edit_complete.php?mode=1');

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:user_edit_complete.php?mode=2");
}


?>
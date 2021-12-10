<?php 
session_start();
require_once 'Logic/Authent_Logic.php';

try{

    if(!isset($_SESSION['user'])){
        header('Location:index.php');
    }

    /* 前ページと入力フォームを介しているか */
    if(!isset($_POST['send']) || !isset($_SESSION['tmp_user'])){
        unset($_SESSION['tmp_user']);
        header('Location:user_edit_complete.php?mode=0');
    }

    /* ユーザー登録処理 */
    if(!Authent_Logic::user_edit($_SESSION['tmp_user'],$_SESSION['user']['id'])){
        unset($_SESSION['tmp_user']);
        header('Location:user_edit_complete.php?mode=0');
    }

    unset($_SESSION['tmp_user']);
    header('Location:user_edit_complete.php?mode=1');

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:user_edit_complete.php?mode=2");
}


?>
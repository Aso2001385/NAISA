<?php 
session_start();
require_once 'Logic/Authent_Logic.php';
try{
    /* 前ページと入力フォームを介しているか */
    if(!isset($_POST['send']) || !isset($_SESSION['register'])){
        unset($_SESSION['register']);
        header('Location:register_complete.php?mode=0');
    }

    /* ユーザー登録処理 */
    if(!Authent_Logic::user_register($_SESSION['register'])){
        unset($_SESSION['register']);
        header('Location:register_complete.php?mode=0');
    }

    /* カード登録処理 */
    if(isset($_SESSION['card'])){

        if(!Authent_Logic::card_rigister($_SESSION['card'],$_SESSION['register']['mail'])){
            unset($_SESSION['register']);
            unset($_SESSION['card']);
            header('Location:register_complete.php?mode=1');
        }
        unset($_SESSION['card']);
    }

    unset($_SESSION['register']);
    header('Location:register_complete.php?mode=2');

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:register_complete.php?mode=3&message={$message}");
}


?>
<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

try{

    if(isset($_SESSION['user'])){
        header('Location:index.php');
        exit();
    }

    /* 前ページと入力フォームを介しているか */
    if(!isset($_POST['send']) || !isset($_SESSION['tmp_user'])){
        unset($_SESSION['tmp_user']);
        header('Location:user_register_complete.php?mode=2');
        exit();
    }

    
    /* ユーザー登録処理 */
    $act = Authent_Logic::user_register($_SESSION['tmp_user']);

    if(isset($act['check'])){
        if(!$act['check']){
            unset($_SESSION['card']);
            if($act['error_type'] == 0){
                header("Location:user_register.php?column={$act['column']}&errors={$act['errors']}");
                exit();
            }else{
                header('Location:user_register_complete.php?mode=2');
                exit();
            }
        }
    }
    

    /* カード登録処理 */
    if(isset($_SESSION['card'])){

        if(!Authent_Logic::card_rigister($_SESSION['card'],$_SESSION['tmp_user']['mail'])){
            unset($_SESSION['tmp_user']);
            unset($_SESSION['card']);
            header('Location:user_register_complete.php?mode=1');
            exit();
        }
        unset($_SESSION['card']);
    }

    unset($_SESSION['tmp_user']);
    header('Location:user_register_complete.php?mode=0');
    exit();

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:user_register_complete.php?mode=2");
    exit();
}


?>
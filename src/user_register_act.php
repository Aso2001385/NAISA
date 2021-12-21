<?php 
session_start();
require_once 'Logic/Authent_Logic.php';
/*

mode 登録状況

    0 登録完了
    1 カード登録失敗
    2 問題発生

*/

try{

    if(isset($_SESSION['user'])){
        header('Location:index.php');
    }

    /* 前ページと入力フォームを介しているか */
    if(!isset($_POST['send']) || !isset($_SESSION['tmp_user'])){
        unset($_SESSION['tmp_user']);
        header('Location:user_register_complete.php?mode=2');
    }

    
    /* ユーザー登録処理 */
    $act = Authent_Logic::user_register($_SESSION['tmp_user']);

    if(!$act['check']){
        unset($_SESSION['card']);
        if($act['error_type'] == 0){
            header("Location:user_register.php?column={$act['column']}&errors={$act['errors']}");
        }else{
            header('Location:user_register_complete.php?mode=2');
        }
    }

    /* カード登録処理 */
    if(isset($_SESSION['card'])){

        if(!Authent_Logic::card_rigister($_SESSION['card'],$_SESSION['tmp_user']['mail'])){
            unset($_SESSION['tmp_user']);
            unset($_SESSION['card']);
            header('Location:user_register_complete.php?mode=1');
        }
        unset($_SESSION['card']);
    }

    unset($_SESSION['tmp_user']);
    header('Location:user_register_complete.php?mode=0');

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:user_register_complete.php?mode=2");
}


?>
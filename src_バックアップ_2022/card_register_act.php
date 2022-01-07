<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Purchase_Logic.php';

try{

    if(!isset($_SESSION['user']) || !isset($_POST['card'])){
        header('Location:index.php');
    }

    /* カード登録処理 */
    if(isset($_POST['card'])){
        if(!Purchase_Logic::card_rigister($_POST['card'],$_SESSION['user']['id'])){
            header('Location:user_register_complete.php?mode=3');
        }
    }

    $act = Purchase_Logic::get_new_card($_SESSION['user']['id']);
    unset($_SESSION['order']['card_id']);
    $_SESSION['order']['card_id'] = $act['data'][0]['id'];
    header('Location:buy_act.php');

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:user_register_complete.php?mode=3");
}


?>
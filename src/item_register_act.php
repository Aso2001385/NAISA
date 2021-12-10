<?php 
session_start();
require_once 'Logic/Authent_Logic.php';
require_once 'Logic/Exhibit_Logic.php';

try{

    /* 前ページと入力フォームを介しているか */
    // if(!isset($_POST['send']) || !isset($_SESSION['tmp_item']) || !isset($_SESSION['tmp_image'])){
    //     unset($_SESSION['tmp_item']);
    //     unset($_SESSION['tmp_image']);
    //     header('Location:item_register_complete.php?mode=0');
    // }

    $act = Exhibit_Logic::image_download($_SESSION['tmp_image']['name'],$_SESSION['tmp_image']['type'],500);
    // unset($_SESSION['tmp_image']);

    if(!$act['check']){
        // unset($_SESSION['tmp_item']);
        header('Location:item_register_complete.php?mode=0');
    }

    if(!Exhibit_Logic::item_register($_SESSION['tmp_item'],$act['image_name'],$_SESSION['user']['id'])){
        header('Location:item_register_complete.php?mode=0');
    }

    unset($_SESSION['tmp_item']);
    header('Location:item_register_complete.php?mode=1');

}catch(Exception $e){
    $message = $e->getMessage();
    header("Location:item_register_complete.php?mode=2");
}


?>
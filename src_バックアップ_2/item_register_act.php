<?php 
session_start();
if(!isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
}
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Exhibit_Logic.php';


try{

    $act = Exhibit_Logic::image_download($_SESSION['tmp_image']['name'],$_SESSION['tmp_image']['type'],500);

    if(!$act['check']){
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
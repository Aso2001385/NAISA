<?php 
session_start();
require_once 'Logic/Purchase_Logic.php';

if(isset($_POST['order'])){
    $order = $_POST['order'];
}else if(isset($_SESSION['order'])){
    $order = $_SESSION['order'];
    unset($_SESSION['order']);
}else{
    header('Location:index.php');
}



if($order['card_id'] == 0){
    $_SESSION['order'] = $order;
    header('Location:add_card_register.php');
}else{
    $act = Purchase_Logic::buy_act($order);

    if($act['flg']){
        header('Location:buy_complete.php?mode=0');
    }else if(!$act['check']){
        header('Location:buy_complete.php?mode=1');
    }else{
        header("Location:buy_complete.php?mode=2&id={$order['item_id']}");
    }
    
}

?>
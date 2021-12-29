<?php
session_start();
require_once 'Logic/Purchase_Logic.php';
require_once 'Logic/Exhibit_Logic.php';

$mode = $_GET['mode'];
// 0 発送通知
// 1 受け取り通知

if($mode == 0){
    $act = Exhibit_Logic::order_send_notic($_GET['id'],$_SESSION['user']['id']);
}else{
    $act = Purchase_Logic::order_recived_notic($_GET['id'],$_SESSION['user']['id']);
}

header("Location:order.php?id={$_GET['id']}");

?>
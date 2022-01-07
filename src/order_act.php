<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
}
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Purchase_Logic.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Exhibit_Logic.php';

$mode = $_GET['mode'];

if($mode == 0){
    $act = Exhibit_Logic::order_send_notic($_GET['id'],$_SESSION['user']['id']);
}else{
    $act = Purchase_Logic::order_recived_notic($_GET['id'],$_SESSION['user']['id']);
}

header("Location:order.php?id={$_GET['id']}");

?>
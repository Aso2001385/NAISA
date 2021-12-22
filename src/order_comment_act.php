<?php
session_start();
require_once 'logic/Comment_Logic.php';

if(!isset($_POST['comment']) || !isset($_POST['order_info'])){

}

$comment = $_POST['comment'];
$order_info = $_POST['order_info'];
$comment = array_merge($comment,['user_id'=>$_SESSION['user']['id']]);

$act = Comment_Logic::add_order_comment($comment,$order_info);

header("Location:order.php?id={$comment['order_id']}");

?>
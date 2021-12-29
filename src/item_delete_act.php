<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Exhibit_Logic.php';

if(!isset($_SESSION['user']) || !isset($_GET['id'])) header('Location:index.php');

$id = $_GET['id'];

if(Exhibit_Logic::item_delete($id,$_SESSION['user']['id'])){
    header('Location:item_delete_complete.php?mode=0');
}else{
    header('Location:item_delete_complete.php?mode=1');
}


?>
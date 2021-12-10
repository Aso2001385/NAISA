<?php
session_start();
require_once 'Logic/Purchase_Logic.php';
$page_css = 'user_register';

// $item_id = $_GET['item_id'];
$item_id = 1;

$act = Purchase_Logic::item_detail($item_id);

if(isset($act['check'])){
    $item = $act['data'];
}
$mode = 0;
if(isset($_SESSION['user'])){
    if($_SESSION['user']['id'] == $item['user_id']){
        $mode = 1;
    }
}

require_once 'header.php';
?>

<div class="contents">

    <form action="buy.php" method="post">
        <div class="item_box">
            <div class="left">
                <div class="buyer_name">
                </div>
                <div class="image_frame">

                </div>
                <div class="buy_btn">
                </div>
            </div>
            <div class="right">
                <div class="item_info">
                </div>
                <div class="act_btns">
                    <div class="act_btn"></div>
                    <div class="act_btn"></div>
                </div>
            </div>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
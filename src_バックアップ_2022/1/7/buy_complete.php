<?php 
session_start();

if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}else{
    $mode = 0;
}

$item_id = $_GET['id'];

$output = [
    '大変申し訳ございません<br>この商品はすでに購入されています',
    '致命的なエラーが発生しました<br>再度やり直して下さい',
    '購入が完了しました<br><span>発送まで暫くお待ちください</span>',
];

$btns = [
    ['index.php','item_detail.php',"order.php?item_id={$item_id}"],
    ['トップページへ','商品詳細に戻る','購入した商品を見る']
];

$page_css = 'user_register_complete';
require_once 'header.php';

?>

<div class="contents">
    <div class="form_inner">
        <div class="heading_word">
            <?php echo $output[$mode] ?>
        </div>
        <a href="<?php echo $btns[0][$mode]?>"><button class="next_btn" name="send" value="send"><?php echo $btns[1][$mode]?></button>
    </div>
</div>

<?php

require_once 'footer.php';

?>
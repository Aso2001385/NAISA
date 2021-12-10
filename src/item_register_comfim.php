<?php 
session_start();
require_once 'Logic/Authent_Logic.php';
require_once 'Logic/Exhibit_Logic.php';


if(isset($_SESSION['tmp_item'])){
    unset($_SESSION['tmp_item']);
}
if(isset($_SESSION['tmp_image'])){
    unset($_SESSION['tmp_image']);
}

if(!Authent_Logic::login_check()){
    header('Location:index.php');
}
if(!isset($_POST['item'])||!$_FILES['image']){
    header('Location:index.php');
}

$_SESSION['tmp_item'] = $_POST['item'];
$act = Exhibit_Logic::tmp_image_add($_FILES['image']);

if($act['check']){
    $_SESSION['tmp_image']['name'] = $act['tmp_image_name'];
    $_SESSION['tmp_image']['type'] = $act['tmp_image_type'];
}

$user_output = '';
$names = [ 
    ['name','name_read','price','quality','delivery_fee','delivery_days','description'],
    ['商品名','ヨミガナ','価格','商品状態','配送料負担','発送までの日数','商品説明']
];
$opt_val = [
    ['美品','傷有り','汚れ有り','ジャンク品'],
    ['出品者負担','購入者負担'],
    ['1日以内','3日以内','1週間以内','2週間以内','1ヶ月以内','1ヶ月以上']
];

for($i=0; $i<7; $i++){
    if($i == 2){
        $tags = "<div class='subject'>{$names[1][$i]}:￥{$_POST['item'][$names[0][$i]]}</div>";
    }else if($i>2 && $i<6){
        $tags = "<div class='subject'>{$names[1][$i]}:{$opt_val[$i-3][$_POST['item'][$names[0][$i]]]}</div>";
    }else if($i == 6){
        $in_val = nl2br($_POST['item'][$names[0][$i]]);
        $tags = "<div class='subject'>{$names[1][$i]}:<br>{$in_val}</div>";
    }else{
        $tags = "<div class='subject'>{$names[1][$i]}:{$_POST['item'][$names[0][$i]]}</div>";
    }
    $user_output .= "<div class='input_box'>{$tags}</div>";
}

$page_css = 'item_register_comfim';
require_once 'header.php';

?>

<div class="contents">
    <form action="item_register_act.php" enctype="multipart/form-data" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">入力内容</div>
                <?php echo $user_output; ?>
            </div>
            <button class="next_btn" name="send" value="send">次へ</button>
            <div class="link" >
                <a href="item_register.php">再入力</a>
            </div>
        </div>
    </form>
</div>

<?php

require_once 'footer.php';

?>
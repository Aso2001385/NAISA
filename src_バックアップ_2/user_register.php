<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

$page_css = 'user_register';
$in_val = ['','','','','','','','',''];
$i=0;

if(isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
}

$option = [
    'subject' => ['名前','ヨミガナ','ニックネーム','電話番号','メールアドレス','パスワード','パスワード(確認用)','郵便番号'],
    'name' => ['name','name_read','nick_name','tel','mail','pass','re_pass','post'],
    'type' => ['text','text','text','tel','mail','password','password','text'],
    'minlength' => [2,2,1,11,0,8,8,7],
    'maxlength' => [50,100,50,11,0,30,30,7],
    'pattern' => ["^[a-zA-Z一-龠ぁ-んーァ-ヶー]+$","^[ァ-ヶー]+$",0,0,"^[a-zA-Z0-9@\-_.]+$","^[a-zA-Z0-9\-_]+$","^[a-zA-Z0-9\-_]+$","^[0-9]+$"],
];

$input_box = '';

for($i=0; $i<7; $i++){

    $input_box .= "<div class='input_box'><div class='subject'>{$option['subject'][$i]}";
    if(isset($_GET['column'])){
        if($_GET['column'] === $option['name'][$i]) $input_box .= "<span>:{$_GET['errors']}</span>"; ;
    }
    $input_box .="</div><div class='input'>";
    $input_box .= "<input type='{$option['type'][$i]}' name='user[{$option['name'][$i]}]'";

    if($option['minlength'][$i] != 0){
        $input_box .= "minlength='{$option['minlength'][$i]}'";
    }
    if($option['maxlength'][$i] != 0){
        $input_box .= "maxlength='{$option['maxlength'][$i]}'";
    }
    if($option['pattern'][$i] != 0){
        $input_box .= "pattern='{$option['pattern'][$i]}'";
    }

    if(isset($_SESSION['tmp_user'])){
        if($i!=5 && $i!=6){
            $input_box .= "value='{$_SESSION['tmp_user'][$option['name'][$i]]}'";
        }
    }

    $input_box .= "require_onced></div></div>";

}

$address_box  = "<div class='input_box'><div class='subject'>郵便番号</div>";
$address_box .= "<div class='input'><input type='text' name='user[post]' pattern='^[0-9]+$' minlength='7' maxlength='7'";
if(isset($_SESSION['tmp_user'])){
    $address_box .= "value='{$_SESSION['tmp_user']['post']}'";
}
$address_box .= "require_onced></div></div>";

$address_box  .= "<div class='input_box'><div class='subject'>住所</div>";
$address_box .= "<div class='input'><input type='text' name='user[address]' maxlength='100'";
if(isset($_SESSION['tmp_user'])){
    $address_box .= "value='{$_SESSION['tmp_user']['address']}'";
}
$address_box .= "require_onced></div></div>";



if(isset($_SESSION['card'])) unset($_SESSION['card']);


require_once 'header.php';
?>

<div class="contents">

    <form action="card_register.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">新規登録</div>
                <?php echo $input_box; ?>
            </div>
            <div class="form_inner">
                <div class="heading_word">住所入力</div>
                <?php echo $address_box ?>
            </div>
            <button class="next_btn">次へ</button>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
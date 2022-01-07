<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}else{
    $mode = 2;
}

$output = [
    '会員登録が完了しました',
    '会員登録が完了しました<br><span>クレジットカードの登録に失敗しました</span>',
    '問題が発生しました<br>再度やり直してください',
];

$btns = [
    ['login','login','user_register'],
    ['ログイン','ログイン','再入力']
];

$page_css = 'user_register_complete';

require_once 'header.php';

?>

<div class="contents">
    <div class="form_inner">
        <div class="heading_word">
            <?php echo $output[$mode] ?>
        </div>
        <a href="<?php echo $btns[0][$mode]?>.php"><button class="next_btn" name="send" value="send"><?php echo $btns[1][$mode]?></button>
    </div>
</div>

<?php

require_once 'footer.php';

?>
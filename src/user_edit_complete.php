<?php 
session_start();
require_once 'Logic/Authent_Logic.php';

if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}else{
    $mode = 0;
}

$output = [
    '問題が発生しました<br>再度やり直してください',
    '変更が完了しました',
    '致命的なエラーが発生しました<br>再度やり直して下さい',
];

$btns = [
    ['user_edit','user_edit','user_edit'],
    ['再入力','再入力','再入力']
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
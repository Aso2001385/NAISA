<?php 
session_start();

if(!isset($_SESSION['user'])) header('Location:index.php');

$mode = $_GET['mode'];

if($mode == 0){
    $word = '商品は削除されました';
}else{
    $word = '予期せぬエラーが発生しました';
}

$page_css = 'user_register_complete';

require_once 'header.php';

?>

<div class="contents">
    <div class="form_inner">
        <div class="heading_word">
            <?php echo $word ?>
        </div>
        <a href="index.php"><button class="next_btn" name="send" value="send">トップページへ</button></a>
    </div>
</div>

<?php

require_once 'footer.php';

?>
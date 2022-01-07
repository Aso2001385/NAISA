<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

if(!isset($_SESSION['user']) || !isset($_POST['items']['id'])) header('Location:index.php');

$id = $_POST['items']['id'];

$page_css = 'user_register_complete';

require_once 'header.php';

?>

<div class="contents">
    <div class="form_inner">
        <div class="heading_word">
            本当に商品を削除しますか？
        </div>
        <a href="item_delete_act.php?id=<?php echo $id ?>"><button class="next_btn" name="send" value="send">削除</button></a>
    </div>
</div>

<?php

require_once 'footer.php';

?>
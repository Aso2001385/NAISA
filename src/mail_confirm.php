<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

if(isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
}

$error = '';

if(isset($_GET['param'])) $error = "<span>:コードが間違っています</span>";


$page_css = 'user_register';
require_once 'header.php';
?>

<div class="contents">

    <form action="user_register_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">確認コード入力</div>
                <div class="input_box">
                    <div class="subject">確認コード（６桁）<?php echo $error; ?></div>
                    <div class="input">
                        <input type="text" name="cord" minlength="6" maxlength="6" pattern="^[0-9]+$" require_onced>
                    </div>
                </div>
            </div>
            <button class="next_btn">次へ</button>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
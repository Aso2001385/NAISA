<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

$page_css = 'login_failed';
require_once 'header.php';

?>

<div class="contents">
    <div class="form_inner">
        <div class="heading_word">
            ログインできませんでした
        </div>
        <div class="input_box">
            <div class="input">メールアドレスまたはパスワードが間違っています</div>
            <br>
        </div>

        <div class="link">
            <a href="login.php">ログインページへ</a>
        </div> 
        <div class="link">
            <a href="index.php">トップページへ</a>
        </div>
     
    </div>
</div>

<?php

require_once 'footer.php';

?>
<?php
session_start();
require_once 'Logic/Authent_Logic.php';
if(isset($_SESSION['user'])){
    //り
}
$page_css = 'login';
require_once 'header.php';
?>

<div class="contents">

    <form action="login_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
            <div class="heading_word">ログイン</div>
                <div class="input_box">
                    <div class="subject">メールアドレス</div>
                    <div class="input"><input type="mail" name="user[mail]" pattern="^[a-zA-Z0-9@\-_.]+$" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">パスワード</div>
                    <div class="input"><input type="password" name="user[pass]" pattern="^[a-zA-Z0-9\-_]+$" minlength="8" maxlength="30" required></div>
                </div>
            </div>
            <button class="next_btn">ログイン</button>
            <div class="link">
                <a href="user_register.php">新規登録</a>
            </div>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
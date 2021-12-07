<?php
session_start();
require_once 'Logic/Authent_Logic.php';

$page_css = 'register';

// $check = Authent_Logic::login_check();

// if($check){
//     header('Location:index.php');
// }
require_once 'header.php';
?>

<div class="contents">

    <form action="register-act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">新規登録</div>
                <div class="input_box">
                    <div class="subject">名前</div>
                    <div class="input"><input type="text" name="user[name]"></div>
                </div>
                <div class="input_box">
                    <div class="subject">名前(カタカナ)</div>
                    <div class="input"><input type="text" name="user[name_read]"></div>
                </div>
                <div class="input_box">
                    <div class="subject">ニックネーム</div>
                    <div class="input"><input type="text" name="user[nick_name]"></div>
                </div>
                <div class="input_box">
                    <div class="subject">電話番号</div>
                    <div class="input"><input type="tel"></div>
                </div>
                <div class="input_box">
                    <div class="subject">メールアドレス</div>
                    <div class="input"><input type="mail" name="user[mail]"></div>
                </div>
                <div class="input_box">
                    <div class="subject">パスワード</div>
                    <div class="input"><input type="password" name="user[pass]"></div>
                </div>
                <div class="input_box">
                    <div class="subject">パスワード(確認)</div>
                    <div class="input"><input type="password" name="user[re_pass]"></div>
                </div>
            </div>
            <div class="form_inner">
                <div class="heading_word">住所入力</div>
                <div class="input_box">
                    <div class="subject">郵便番号</div>
                    <div class="input"><input type="text" name="user[post]"></div>
                </div>
                <div class="input_box">
                    <div class="subject">住所</div>
                    <div class="input"><input type="text" name="user[address]"></div>
                </div>
            </div>
            <button class="next_btn">次へ</button>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
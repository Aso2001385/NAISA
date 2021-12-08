<?php
session_start();
require_once 'Logic/Authent_Logic.php';

$page_css = 'user_register';
$in_val = ['','','','','','','','',''];
$i=0;
if(isset($_SESSION['register'])){
    
    foreach($_SESSION['register'] as $row){
        $in_val[$i++] = $row;
    }
    unset($_SESSION['register']);
}
if(isset($_SESSION['card'])){
    unset($_SESSION['card']);
}

// Authent_Logic::login_check();

require_once 'header.php';
?>

<div class="contents">

    <form action="card_register.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">新規登録</div>
                <div class="input_box">
                    <div class="subject">名前</div>
                    <div class="input"><input type="text" name="user[name]" pattern="^[a-zA-Z一-龠ぁ-んーァ-ヶー]+$" minlength="2" maxlength="50" value="<?php echo $in_val[0] ?>" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">ヨミガナ</div>
                    <div class="input"><input type="text" name="user[name_read]" pattern="^[ァ-ヶー]+$" minlength="2" maxlength="100" value="<?php echo $in_val[1] ?>" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">ニックネーム</div>
                    <div class="input"><input type="text" name="user[nick_name]" minlength="1" maxlength="50" value="<?php echo $in_val[2] ?>" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">電話番号</div>
                    <div class="input"><input type="tel" name="user[tel]" minlength="11" maxlength="12" value="<?php echo $in_val[3] ?>" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">メールアドレス</div>
                    <div class="input"><input type="mail" name="user[mail]" pattern="^[a-zA-Z0-9@-_.]+$" value="<?php echo $in_val[4] ?>" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">パスワード</div>
                    <div class="input"><input type="password" name="user[pass]" pattern="^[a-zA-Z0-9-_]+$" minlength="8" maxlength="30" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">パスワード(確認)</div>
                    <div class="input"><input type="password" name="user[re_pass]" pattern="^[a-zA-Z0-9-_]+$" minlength="8" maxlength="30" required></div>
                </div>
            </div>
            <div class="form_inner">
                <div class="heading_word">住所入力</div>
                <div class="input_box">
                    <div class="subject">郵便番号</div>
                    <div class="input"><input type="text" name="user[post]" pattern="^[0-9]+$" minlength="7" maxlength="7" value="<?php echo $in_val[7] ?>" required></div>
                </div>
                <div class="input_box">
                    <div class="subject">住所</div>
                    <div class="input"><input type="text" name="user[address]" value="<?php echo $in_val[8] ?>" required></div>
                </div>
            </div>
            <button class="next_btn">次へ</button>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
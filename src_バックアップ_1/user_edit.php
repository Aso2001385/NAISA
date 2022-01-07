<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

if(!isset($_SESSION['user'])){
  //リダイレクト
}

$page_css = 'user_register';
$in_val = ['','','','','','','','',''];
$i=0;
$key = array_keys($_SESSION['user']);

foreach($key as $row){
  if($row === 'id' || $row === 'pass' ){
    continue;
  }
  $in_val[$i++] = $_SESSION['user'][$row];
}



// Authent_Logic::login_check();

require_once 'header.php';
?>

<div class="contents">

    <form action="user_edit_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">アカウント情報編集</div>
                <div class="input_box">
                    <div class="subject">名前</div>
                    <div class="input"><input type="text" name="user[name]" pattern="^[a-zA-Z一-龠ぁ-んーァ-ヶー]+$" minlength="2" maxlength="50" value="<?php echo $in_val[0] ?>" require_onced></div>
                </div>
                <div class="input_box">
                    <div class="subject">ヨミガナ</div>
                    <div class="input"><input type="text" name="user[name_read]" pattern="^[ァ-ヶー]+$" minlength="2" maxlength="100" value="<?php echo $in_val[1] ?>" require_onced></div>
                </div>
                <div class="input_box">
                    <div class="subject">ニックネーム</div>
                    <div class="input"><input type="text" name="user[nick_name]" minlength="1" maxlength="50" value="<?php echo $in_val[2] ?>" require_onced></div>
                </div>
                <div class="input_box">
                    <div class="subject">電話番号</div>
                    <div class="input"><input type="tel" name="user[tel]" minlength="11" maxlength="12" value="<?php echo $in_val[4] ?>" require_onced></div>
                </div>
                <div class="input_box">
                    <div class="subject">メールアドレス</div>
                    <div class="input"><input type="mail" name="user[mail]" pattern="^[a-zA-Z0-9@\-_.]+$" value="<?php echo $in_val[3] ?>" require_onced></div>
                </div>
            </div>
            <div class="form_inner">
                <div class="heading_word">住所編集</div>
                <div class="input_box">
                    <div class="subject">郵便番号</div>
                    <div class="input"><input type="text" name="user[post]" pattern="^[0-9]+$" minlength="7" maxlength="7" value="<?php echo $in_val[5] ?>" require_onced></div>
                </div>
                <div class="input_box">
                    <div class="subject">住所</div>
                    <div class="input"><input type="text" name="user[address]" value="<?php echo $in_val[6] ?>" require_onced></div>
                </div>
            </div>
            <button class="next_btn">変更する</button>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
<?php 
session_start();
require_once 'Logic/Authent_Logic.php';
require_once 'Logic/Validation/Special_Val.php';

if(isset($_SESSION['user'])) header('Location:index.php');


$act = Authent_Logic::input_retention($_POST['user']);

if(!$act['check']) header("Location:user_register.php?column={$act['column']}&errors={$act['errors']}");

$month_opt = '';
$year_opt = '';

for($i=1;$i<13;$i++){

    if($i<10){
        $month_opt .= "<option value='0{$i}'>0{$i}</option>";
    }else{
        $month_opt .= "<option value='{$i}'>{$i}</option>";
    }
    
}

for($i=21;$i<31;$i++){
    $year_opt .= "<option value='{$i}'>{$i}</option>";
}

$page_css = 'card_register';
require_once 'header.php';
?>

<div class="contents">

    <form action="user_register_comfim.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">お支払い方法登録</div>
                <div class="input_box">
                    <div class="subject">カード番号</div>
                    <div class="input"><input type="text" name="card[code]" minlength="14" maxlength="19" pattern="^[0-9]+$" required></div>
                </div>
                <div class="input_box" id="limits">
                    <div class="subject">有効期限</div>
                    <div class="input lim">
                        <select class="limit" name="card[month]" id="munth"><?php echo $month_opt ?></select> 月
                    </div>
                    <div class="input lim">
                        <select class="limit" name="card[year]"><?php echo $year_opt ?></select> 年
                    </div>
                </div>
                <div class="input_box" id="limits">
                    <div class="subject">セキュリティコード</div>
                    <div class="input lim"><input class="limit" type="text" name="card[security]" minlength="3" maxlength="4"  pattern="^[0-9]+$"  required></div>
                </div>
            </div>
            <button class="next_btn">次へ</button>
            <div class="link">
                <a href="user_register_comfim.php">登録せずにスキップ</a>
            </div>
        </div>
    </form>

    
</div>

<?php

require_once 'footer.php';

?>
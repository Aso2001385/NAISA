<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

if(!isset($_SESSION['user']) || !isset($_POST['user'])){
    header('Location:index.php');
    exit();
}

if(!Authent_Logic::input_retention($_POST['user'])){
    header('Location:user_complete.php?mode=0');
    exit();
}

$user_output = '';

$names = [ 
    ['name','name_read','nick_name','tel','post','address'],
    ['名前','名前(カタカナ)','ニックネーム','電話番号','郵便番号','住所']
];

for($i=0; $i<6; $i++){
    $tags = "<div class='subject'>{$names[1][$i]}:{$_SESSION['tmp_user'][$names[0][$i]]}</div>";
    $user_output .= "<div class='input_box'>{$tags}</div>";
}

$page_css = 'user_register_confirm';
require_once 'header.php';

?>

<div class="contents">
    <form action="user_edit_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">入力内容</div>
                <?php echo $user_output; ?>
            </div>
            <button class="next_btn" name="send" value="send">変更</button>
            <div class="link" >
                <a href="user_register.php">再入力</a>
            </div>
        </div>
    </form>
</div>

<?php

require_once 'footer.php';

?>
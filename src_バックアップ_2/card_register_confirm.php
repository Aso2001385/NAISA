<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

if(!isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
}

if(!isset($_POST['card'])){
    header('Location:index.php');
    exit();
}
$card = $_POST['card'];
$card_output = '';

$names = [ 
    ['code','month','year'],
    ['カード番号','月','年']
];

for($i=0; $i<3; $i++){
    $tags = "<div class='subject'>{$names[1][$i]}:{$card[$names[0][$i]]}</div>";
    $card_output .= "<div class='input_box'>{$tags}</div>";
}

foreach($names[0] as $row){
    $card_output .= "<input type='hidden' name='card[{$row}]' value='{$card[$row]}'>";
}

$card_output .= "<input type='hidden' name='card[security]' value='{$card['security']}'>";

$page_css = 'user_register_confirm';
require_once 'header.php';

?>

<div class="contents">
    <form action="card_register_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">お支払い方法</div>
                <?php echo $card_output; ?>
            </div>
            <button class="next_btn" name="send" value="send">次へ</button>
            <div class="link">
                <a href="user_register.php">再入力</a>
            </div>
        </div>
    </form>
</div>

<?php

require_once 'footer.php';

?>
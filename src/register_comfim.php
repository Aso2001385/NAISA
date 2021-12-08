<?php 
session_start();
require_once 'Logic/Authent_Logic.php';

$page_css = 'register_comfim';
if(isset($_POST['card'])){

    $_SESSION['card'] = $_POST['card'];
    $card_output = '';
    
    $names = [ 
        ['code','month','year'],
        ['カード番号','月','年']
    ];
  
    for($i=0; $i<3; $i++){
        $tags = "<div class='subject'>{$names[1][$i]}：{$_SESSION['card'][$names[0][$i]]}</div>";
        $card_output .= "<div class='input_box'>{$tags}</div>";
    }
    
}else{
    $card_output = '<div class="subject">登録をスキップしました</div>';
}

if(Authent_Logic::login_check()){
    header('Location:index.php');
}

$user_output = '';
$names = [ 
    ['name','name_read','nick_name','tel','mail','post','address'],
    ['名前','名前(カタカナ)','ニックネーム','電話番号','メールアドレス','郵便番号','住所']
];

for($i=0; $i<7; $i++){
    $tags = "<div class='subject'>{$names[1][$i]}：{$_SESSION['register'][$names[0][$i]]}</div>";
    $user_output .= "<div class='input_box'>{$tags}</div>";
}

require_once 'header.php';

?>

<div class="contents">
    <form action="register_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">入力内容</div>
                <?php echo $user_output; ?>
            </div>
            <div class="form_inner">
                <div class="heading_word">お支払い方法</div>
                <?php echo $card_output; ?>
            </div>
            <button class="next_btn" name="send" value="send">次へ</button>
            <div class="skip_link" >
                <a href="user_register.php">再入力</a>
            </div>
        </div>
    </form>
</div>

<?php

require_once 'footer.php';

?>
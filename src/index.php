<?php
session_start();

$style = "<link rel='stylesheet' href='css/$page.css'>";

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0 user-scalable=no">
    <title>商品詳細</title>
    <link rel="stylesheet" href='css\index.css'>
    <?php echo $style ?>
</head>
<body>
    <div class="menu">
        <header>
            <div id="head_left_names">
                <div id="hospital_name">デモクリニック</div>
                <div id="account_name">
                
                </div>
            </div>
            <div id="site_name">Sharet</div>
            <div id="logout">ログアウト</div>
        </header>
        <nav>
            <a class="menu_btn" id="btn1" href="http://localhost/D-E-C_team-H/public/sharet">
                <div class="menu_icon"></div>
                <div class="menu_text">投稿一覧</div>
            </a>
            <a class="menu_btn" id="btn2" href="http://localhost/D-E-C_team-H/public/create">
                <div class="menu_icon"></div>
                <div class="menu_text">投稿する</div>
            </a>
            <a class="menu_btn" id="btn3" href="http://localhost/D-E-C_team-H/public/mypage">
                <div class="menu_icon"></div>
                <div class="menu_text">マイページ</div>
            </a>
            <a class="menu_btn" id="btn4" href="http://localhost/D-E-C_team-H/public/hello">
                <div class="menu_icon"></div>
                <div class="menu_text">お気に入りリスト</div>
            </a>
            <a class="menu_btn" id="btn5" href="http://localhost/D-E-C_team-H/public/hello">
                <div class="menu_icon"></div>
                <div class="menu_text">Coming soon...</div> 
            </a>
            <a class="menu_btn" id="btn6" href="http://localhost/D-E-C_team-H/public/hello">
                <div class="menu_icon"></div>
                <div class="menu_text">Coming soon...</div>
            </a>
        </nav>
    </div>
    <div class="contents">
        <?php require("itemDetail.php"); ?>
    </div>

    <div class="footer">
        <footer>
            
        </footer>
    </div>
</body>
</html>
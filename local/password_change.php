<!--header-->
<?php require_once('header.php'); ?>
<link rel="stylesheet" href="css/password_change.css">

<!--main-->
<div class="main">
<div class="middle-wrap">
  <div class="big-title center">パスワード変更</div>
  <br><br><br>
  <div class="text">現在のパスワード</div>
  <input type="text" class="white-box" require_onced>
  <br><br><br>
  <div class="text">新しいパスワード</div>
  <input type="text" class="white-box" require_onced>
  <br><br><br>
  <div class="text">新しいパスワード（確認）</div>
  <input type="text" class="white-box" require_onced>
  <br><br><br><br>
  <button class="button center">変更を保存</button>
</div>
</div>

<!--footer-->
<?php require_once('footer.php'); ?>
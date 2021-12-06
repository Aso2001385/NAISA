<!--header-->
<?php require('header.php'); ?>
<link rel="stylesheet" href="css/deal.css">

<!--main-->
<div class="main">
<div class="main-wrap flex">
  <div class="main-left">
    <div class="title border">取引情報</div>
    <div class="text border">出品者情報（ニックネーム）</div>
    <div class="img-contents border">
      <div class="img-box"></div>
      <div class="img-text text">商品名</div>
    </div>
    <div class="border">
      <div class="text line-space">商品代金　￥値段</div>
      <div class="text line-space">購入日時　YYYY/mm/dd</div>
    </div>
    <div class="text border space">お届け先</div>
  </div>
  <div class="main-right">
    <div class="title">取引画面</div>
    <br>
    <button class="button clear-notice-button">受け取り完了を通知</button>
    <br><br><br><br>
    <div class="title">取引メッセージ</div>
    <br>
    <div class="white-box deal-message-box"></div>
    <br>
    <textarea class="white-box deal-input-box" placeholder="取引メッセージを送る"></textarea>
    <br><br>
    <button class="button submit-button">取引メッセージを送る</button>
  </div>
</div>
</div>

<!--footer-->
<?php require('footer.php'); ?>
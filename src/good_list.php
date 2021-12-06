<!--header-->
<?php require('header.php'); ?>
<link rel="stylesheet" href="css/good_list.css">

<!--main-->
<div class="main">
<div class="main-wrap flex">
  <button class="list-button text">
    出品商品リスト
  </button>
  <div class="list-wrap">
    <div class="big-title border">いいねリスト</div>
    <?php
      for($i=0; $i<7; $i++){
        echo 
        '<div class="img-contents border">
          <div class="img-box"></div>
          <div class="img-text">
            <div class="text">商品名</div>
            <div class="text">￥値段</div>
          </div>
        </div>';
      }
    ?>
  </div>
</div>
</div>

<!--footer-->
<?php require('footer.php'); ?>
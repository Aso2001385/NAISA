<!--header-->
<?php require 'header.php'; ?>
<link rel="stylesheet" href="css/item_list.css">

<!--main-->
<div class="main">
<div class="main-wrap">
  <br><br><br><br>
  <div class="flex">
    <?php
      for($i=0; $i<4; $i++){
        for($j=0; $j<3; $j++){
          echo 
          '
          <div class="item_box">
            <div class="item_image"></div>
            <div class="item_status">
              <div>商品名</div>
              <div>￥値段</div>
            </div>
          </div>
          ';
        }
      }

      echo $data['item_list'];

    ?>


    

  </div>
</div>
</div>

<!--footer-->
<?php require('footer.php'); ?>
<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Purchase_Logic.php';

if(!isset($_SESSION['user'])) header('Location:index.php');

$act = Purchase_Logic::order_list($_SESSION['user']['id']);

$item_box = '';


if(count($act)>0){
  foreach($act as $item){
    $item_box .= "<a href='item_detail.php?item_id={$item['item_id']}'><div class='item_box'><div class='image_box'><img src='img/item/{$item['image']}'></div>";
    $item_box .= "<div class='item_info_box'><div class='item_name'>{$item['name']}</div><div class='item_price'>￥{$item['price']}</div></div></div></a>";
  }  
  unset($item);
}else{
  $item_box .= "<div class='item_box'>購入した商品はありません</div>";
}

$page_css = 'exhibition_list';
require_once('header.php'); 

?>

<div class='contents'>

  <div class="left">

    <div class="link_frame">
      <a href='exhibition_list.php'><div class="link_box">出品履歴</div></a>
    </div>
    
  </div>

  <div class="right">
    <div class="heading_word">購入履歴</div>
    <div class="item_list_frame">
      <?php echo $item_box; ?>
    </div>
  </div> 

</div>
 

<?php require_once('footer.php'); ?>
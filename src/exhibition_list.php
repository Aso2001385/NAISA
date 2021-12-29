<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Exhibit_Logic.php';

$act = Exhibit_Logic::exhibit_list($_SESSION['user']['id']);

$item_box = ['','','',''];

for($i=0; $i<4; $i++){

  if(count($act[$i])>0){
    foreach($act[$i] as $item){
      $item_box[$i] .= "<a href='item_detail.php?item_id={$item['item_id']}'><div class='item_box'><div class='image_box'><img src='img/item/{$item['image']}'></div>";
      $item_box[$i] .= "<div class='item_info_box'><div class='item_name'>{$item['name']}</div><div class='item_price'>￥{$item['price']}</div></div></div></a>";
    }  
    unset($item);
  }else{
    $word = ['取引中の商品はありません','出品中の商品はありません','取引が完了した商品はありません','取引が中断された商品はありません'];
    $item_box[$i] .= "<div class='item_box'>{$word[$i]}</div>";
  }

}

$page_css = 'exhibition_list';
require_once('header.php'); 

?>

<div class='contents'>

  <div class="left">

    <div class="link_frame">
      <a href='purchase_history_list.php'><div class="link_box">購入履歴</div></a>
    </div>
    
  </div>

  <div class="right">

    <div class="heading_word">取引中</div>
    <div class="item_list_frame">
      <?php echo $item_box[0]; ?>
    </div>
    <div class="heading_word">出品中</div>
    <div class="item_list_frame">
      <?php echo $item_box[1]; ?>
    </div>
    <div class="heading_word">取引完了</div>
    <div class="item_list_frame">
      <?php echo $item_box[2]; ?>
    </div>
    <div class="heading_word">取引中断</div>
    <div class="item_list_frame">
      <?php echo $item_box[3]; ?>
    </div>

  </div> 

</div>
 
<?php require_once('footer.php'); ?>
<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Purchase_Logic.php';
if(isset($_SESSION['tmp_user'])) unset($_SESSION['tmp_user']);

$page = (isset($_GET['page'])) ? $_GET['page'] : 0 ;
if(!is_numeric($page)) header('Location:index.php');
$back_page = $page-1;
$next_page = $page+1;

if(isset($_POST['keyword'])){
  if($_POST['keyword'] !== '' && $_POST['keyword'] !== NULL){
    $data = Purchase_Logic::item_search($_POST['keyword'],$page);
  }else{
    $data = Purchase_Logic::item_list($page);
  }
}else{
  $data = Purchase_Logic::item_list($page);
}

if(!$data['check']);

$item = $data['data'];

if(is_bool($item)){

  $output = "<div class='message'>商品が見つかりません</div>";

}else{

  $output = '';
  $cnt = 0;

  foreach($item as $record){
    if($cnt++<24){
      $image_tag  = "<div class='item_image'><img class='img' src='img/item/{$record['image']}'alt='商品画像'></div>";
      $item_name  = "<div class='item_status'><div class='item_name'>{$record['name']}</div>";
      $item_price = "<div class='item_price'>¥{$record['price']}</div></div>";
      $item_block  = "<div class='item_frame'><div class='item_box'><a href='item_detail.php?item_id={$record['id']}'>";
      $item_block .= $image_tag.$item_name.$item_price.'</a></div></div>';
      $output .= $item_block;
    }
  }
  
  $next_link = '';
  
  if($page > 0)  $next_link .= "<a class='next_link' href='index.php?page={$back_page}'>前のページへ<a>";
  if($cnt == 25) $next_link .= "<a class='next_link' href='index.php?page={$next_page}'>次のページへ</a>";

  $output .= "<div class='next_link_frame'>{$next_link}</div>";

}

$page_css = 'item_list';
require_once 'header.php'; 

?>


<div class="contents">
  <?php echo $output; ?>
</div>


<?php require_once 'footer.php'; ?>
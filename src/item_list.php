<!--header-->
<?php
require_once 'src/Logic/Purchase_Logic.php';

$purchase = new Purchase_Logic();

$data = $purchase->item_list();

$output = '';
foreach($data['item_list'] as $record){

  $image_tag  = "
  <div class='item_image'>
  <img class='img' src='/image/item/{$record['image']}'alt='商品画像'>
  </div>";
  $item_name  = "<div class='item_status'>
  <div class='item_name'>{$record['name']}</div>";
  $item_price = "
  <div class='item_price'>¥{$record['price']}</div>
  </div>";

  $item_block  = "<div class='item_box' onclick='DivFrameClick({$record['id']})'>";
  $item_block .= $image_tag.$item_name.$item_price.'</div>';

  $output .= $item_block;

}

require_once 'header.php'; 

?>

<link rel="stylesheet" href="css/item_list.css">

<!--main-->
<div class="main">
<div class="main-wrap">
  <br><br><br><br>
  <div class="flex">
    <?php echo $output; ?>
    <?php echo $output; ?>
    <?php echo $output; ?>
    <?php echo $output; ?>
    <?php echo $output; ?>
  </div>
</div>
</div>

<!--footer-->
<?php require_once 'footer.php'; ?>
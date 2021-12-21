<?php
session_start();
require_once 'Logic/Purchase_Logic.php';


$item_id = $_GET['item_id'];

$act = Purchase_Logic::item_detail($item_id);
$item = $act['item'];
$seller = $act["seller"];
$comment = $act["come"];

if($item['start'] !== NULL){
    $act = Purchase_Logic::detail_get_order($item['id']);
    $order = $act['data'];
}

$seller_flg = false;
if(isset($_SESSION['user'])){
    $seller_flg = $_SESSION['user']['id'] == $item['user_id'];
}

$item_left   = "<div class='seller_name'>{$seller['nick_name']}</div>
<div class='image_frame'><img id='icon' src='img/item/{$item['image']}'></div>";

$item_right  = "<div class='item_info'>";
$keys = array_keys($item);
$subject = [
    'name'=>'商品名','price'=>'価格','quality'=>'商品状態',
    'delivery_fee'=>'発送料負担','delivery_days'=>'発送までの日数'
];
$opt_val = [
    ['美品','傷有り','汚れ有り','ジャンク品'],
    ['出品者負担','購入者負担'],
    ['1日以内','3日以内','1週間以内','2週間以内','1ヶ月以内','1ヶ月以上']
];
$description_text = nl2br($item['description']);
$i=0;
unset($keys[0],$keys[1],$keys[3],$keys[9],$keys[10],$keys[11],$keys[12],$keys[13],$keys[14]);
foreach($keys as $key){
    
    if(is_numeric($item[$key])&&$key !== 'price'){
        $item_right  .= "<div class='info_subject'>{$subject[$key]}</div><div class='info_data'>{$opt_val[$i][$item[$key]]}</div>";
        $item_right .= "<input type='hidden' name='items[{$key}]' value={$opt_val[$i++][$item[$key]]}>";
    }else if($key === 'price'){
        $item_right  .= "<div class='info_subject'>{$subject[$key]}</div><div class='info_data'>￥{$item[$key]}</div>";
        $item_right .= "<input type='hidden' name='items[{$key}]' value={$item[$key]}>";
    }else if($key === 'name'){
        $item_right  .= "<div class='info_subject'>{$subject[$key]}</div><div class='info_data' id='data_name'>{$item[$key]}</div>";
        $item_right .= "<input type='hidden' name='items[{$key}]' value={$item[$key]}>";
    }else if($key === 'description'){

    }else{
        $item_right  .= "<div class='info_subject'>{$subject[$key]}</div><div class='info_data'>{$item[$key]}</div>";
        $item_right .= "<input type='hidden' name='items[{$key}]' value={$item[$key]}>";
    }    
}
$item_right .= "<input type='hidden' name='items[id]' value='{$item_id}'>";
$item_right .= "<input type='hidden' name='items[description]' value='{$description_text}'>";

$item_right  .= "</div>";

if($seller_flg){
    if($item['start'] === NULL){
        $btns = "<button formaction='item_delete.php' class='act_btn' id='seller_btn'>商品を削除する</button>";
    }else{
        $btns = "<button formaction='order.php?id={$order['id']}' class='act_btn' id='seller_btn'>取引ページへ</button>";
    }
    
    $item_act_btn = "<div class='seller_btn_frame'>{$btns}</div>";

}else{

    $buy_btn = "<div class='buyer_btn_frame' id='buy_btn_frame'>";

    if($item['start'] === NULL){

        $buy_btn .= "<button formaction='buy_comfim.php' class='act_btn' id='buy_act_btn'>購入手続きへ</button></div>";

    }else{

        if(isset($_SESSION['user'])){
            if($order['user_id'] == $_SESSION['user']['id']){
                $buy_btn .= "<button formaction='order.php?id={$order['id']}' class='act_btn' id='buy_act_btn'>取引ページへ</button></div>";
            }else{
                $buy_btn .= "<button formaction='index.php' class='act_btn' id='buy_act_btn'>売り切れ(トップページへ)</button></div>";
            }
        }else{
            $buy_btn .= "<button formaction='index.php' class='act_btn' id='buy_act_btn'>売り切れ(トップページへ)</button></div>";
        }

       
    }
    
    $act_btns = "<div class='buyer_btns'><button formaction='like.php' class='act_btn'>いいねする</button></div>";
    $act_btns .= "<div class='buyer_btns'><button formaction='item_report.php' class='act_btn'>通報する</button></div>";
    
    $item_act_btn = "{$buy_btn}<div class='buyer_btn_frame'>{$act_btns}</div>";
}

$description_text = nl2br($item['description']);
$description = "<span class='info_subject'>[ 商品説明 ]</span><br><br>{$description_text}";

$page_css = 'item_detail';

require_once 'header.php';

?>

<div class="contents">

    <form method="post">
        <input type="hidden" name='item_id' value="<?php echo $item['id'] ?>">
        <div class="item_frames">
            <div class="item_frame">
                <?php echo $item_left; ?>
            </div>
            <div class="item_frame" id="right">
                <?php echo $item_right; ?>
            </div>
        </div>
        <div class="act_btns">
            <?php echo $item_act_btn; ?>
        </div>
        <div class="description_frame">
        <div class="description_box">
                <?php echo $description; ?>
            </div>
        </div>

    </form>
    <div class="comment_frame">
            
  
    </div>          
    <div class="comment_input">
        
    </div>
    <div class="act_btns">

    </div>
</div>

<?php

require_once 'footer.php';

?>
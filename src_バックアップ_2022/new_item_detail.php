<?php
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Purchase_Logic.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Exhibit_Logic.php';

$act = Exhibit_Logic::item_confirm($_SESSION['user']['id']);


if(!is_bool($act['item'])){
    $item = $act['item'];
}

$seller_flg = false;
if(isset($_SESSION['user'])){
    $seller_flg = $_SESSION['user']['id'] == $item['user_id'];
}

$item_left   = "<div class='seller_name'>{$_SESSION['user']['nick_name']}</div>
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
    
    if(is_numeric($item[$key]) && $key !== 'price'){
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
$item_right .= "<input type='hidden' name='items[id]' value='{$item['id']}'>";
$item_right .= "<input type='hidden' name='items[description]' value='{$description_text}'>";

$item_right  .= "</div>";

if($seller_flg){
    $btns = "<button formaction='item_delete.php' class='act_btn' id='seller_btn'>商品を削除する</button>";
    $item_act_btn = "<div class='seller_btn_frame'>{$btns}</div>";
}else{
    $buy_btn   = "<div class='buyer_btn_frame' id='buy_btn_frame'><button formaction='buy_confirm.php' class='act_btn' id='buy_act_btn'>購入手続きへ</button></div>";
    $item_act_btn = "{$buy_btn}";
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
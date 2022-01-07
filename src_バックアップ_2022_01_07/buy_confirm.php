<?php 
session_start();
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Purchase_Logic.php';

if(!isset($_POST['item_id']) || !isset($_POST['items'])){
    header('Location:index.php');
}

if(!isset($_SESSION['user'])){
    $_SESSION['detail_id'] = $_POST['item_id'];
    header('Location:login.php');
}

$item = $_POST['items'];
$buyer = $_SESSION['user'];
$card = Purchase_Logic::get_card($buyer['id']);

$subject = [
    'name'=>'商品名','price'=>'価格','quality'=>'商品状態',
    'delivery_fee'=>'発送料負担','delivery_days'=>'発送までの日数','description'=>'商品の説明'
];

$opt_val = [
    ['美品','傷有り','汚れ有り','ジャンク品'],
    ['出品者負担','購入者負担'],
    ['1日以内','3日以内','1週間以内','2週間以内','1ヶ月以内','1ヶ月以上']
];

$item_output = '';
$keys = array_keys($subject);
$i=0;
foreach($keys as $key){
    
    if(is_numeric($item[$key]) && $key !== 'price'){
        $item_output  .= "<div class='subject'>{$subject[$key]} : {$opt_val[$i][$item[$key]]}</div>";
    }else if($key === 'price'){
        $item_output  .= "<div class='subject'>{$subject[$key]} : ￥{$item[$key]}</div>";
    }else if($key === 'name'){
        $item_output  .= "<div class='subject'>{$subject[$key]} : {$item[$key]}</div>";
    }else if($key === 'description'){
        $item_output  .= "<div class='subject'>{$subject[$key]} : <br>{$item[$key]}</div>";
    }else{
        $item_output  .= "<div class='subject'>{$subject[$key]} : {$item[$key]}</div>";
    }
}

$item_output .= "<input type='hidden' name='order[item_id]' value='{$item['id']}'>";
$item_output .= "<input type='hidden' name='order[user_id]' value='{$buyer['id']}'>";

$subject = [
    'post'=>'配送先郵便番号','address'=>'配送先住所',
];

$buyer_output = '';
$keys = array_keys($subject);
foreach($keys as $key){
        $buyer_output  .= "<div class='subject'>{$subject[$key]}<br><input type='text' name='order[{$key}]' value='{$buyer[$key]}'></div>";
}

$card_output = "<div class='subject'>お支払方法選択<br><select name='order[card_id]'>";

if($card['check']){
    foreach($card['data'] as $row){
        $card_output .= "<option value='{$row['id']}'>{$row['code']}</option>";
    }
}

$card_output .= "<option value='0'>新規カードを登録する</option>";
$card_output .= "</select></div>";

$page_css = 'buy_confirm';

require_once 'header.php';

?>

<div class="contents">
    <form action="buy_act.php" method="post">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">この商品を購入しますか？</div>
                <?php echo $item_output; ?>
            </div>
            <div class="form_inner">
                <div class="heading_word">配送先情報の変更</div>
                <?php 
                    echo $buyer_output;
                    echo $card_output;    
                ?>
            </div>
            <button class="next_btn" name="send" value="send">購入</button>
            <div class="link">
                <a href="item_detail.php?item_id=<?php echo $item_id ?>">キャンセルする</a>
            </div>
        </div>
    </form>
</div>

<?php

require_once 'footer.php';

?>
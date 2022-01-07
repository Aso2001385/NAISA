<?php
session_start();
// require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Authent_Logic.php';

// if(!isset($_SESSION['user'])){
//     header('Location:index.php');
// }

$image= $_POST['image'];
$id = $_POST['items']['id'];

$in_item_val = ['','','','','','',''];
$in_image_val = '';

if(isset($_SESSION['tmp_item'])){
    $item = $_SESSION['tmp_item'];
    $i=0;
    foreach($item as $val){
        $in_item_val[$i++] = $val;
    }
}

$i=0;


$opt_val = [
    ['美品','傷有り','汚れ有り','ジャンク品'],
    ['出品者負担','購入者負担'],
    ['1日以内','3日以内','1週間以内','2週間以内','1ヶ月以内','1ヶ月以上']
];

$opt_out = [];

for($c=0; $c<3; $c++){
    $option = '';
    for($j=0; $j<count($opt_val[$c]); $j++){
        if($j == $in_item_val[$c+3]){
            $option .= "<option value='{$j}' selected>{$opt_val[$c][$j]}</option>";
        }else{
            $option .= "<option value='{$j}'>{$opt_val[$c][$j]}</option>";
        }
    }
    $opt_out[$c] = $option;
}

$page_css = 'item_register';
require_once 'header.php';

?>

<div class="contents">
    <form action="item_edit_confirm.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="now_image_name" value="<?php echo $image ?>">
        <input type="hidden" name="now_item_id" value="<?php echo $id ?>">
        <div class="form_outer">
            <div class="form_inner">
                <div class="heading_word">出品する</div>
                <div class="input_box">
                    <div class="subject">商品名</div>
                    <div class="input">
                        <input type="text" name="item[name]" minlength="2" maxlength="50" value="<?php echo $in_item_val[$i++] ?>" require_onced>
                    </div>
                </div>
                <div class="input_box">
                    <div class="subject">商品画像</div>
                    <div class="input">
                        <input type="file" name="image" accept="image/*" value="<?php echo $in_image_val ?>" require_onced>
                    </div>
                </div>
                <div class="input_box">
                    <div class="subject">価格</div>
                    <div class="input">
                        <input type="text" name="item[price]" minlength="3" maxlength="6" value="<?php echo $in_item_val[$i++] ?>" pattern="^[0-9]+$" placeholder="半角数字、100~999999まで" require_onced>
                    </div>
                </div>
                <div class="input_box">
                    <div class="subject">商品状態</div>
                    <div class="input">
                        <select name="item[quality]">
                            <?php echo $opt_out[0] ?>
                        </select>
                    </div>
                </div>
                <div class="input_box">
                    <div class="subject">配送料負担</div>
                    <div class="input">
                        <select name="item[delivery_fee]">
                            <?php echo $opt_out[1] ?>
                        </select>
                    </div>
                </div>
                <div class="input_box">
                    <div class="subject">発送までの日数</div>
                    <div class="input">
                        <select name="item[delivery_days]" require_onced>
                            <?php echo $opt_out[2] ?>
                        </select>
                    </div>
                </div>
                <div class="input_box">
                    <div class="subject">商品説明</div>
                    <div class="input">
                        <textarea name="item[description]" cols="21" rows="6" placeholder="255文字まで" require_onced><?php echo $in_item_val[6] ?></textarea>
                    </div>
                </div>
            </div>
            <button class="next_btn">変更する</button>
        </div>
    </form>

</div>

<?php

require_once 'footer.php';

?>
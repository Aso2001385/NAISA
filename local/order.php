<?php 
session_start();
require_once 'Logic/Purchase_Logic.php';
require_once 'Logic/Comment_Logic.php';

if(!isset($_SESSION['user'])) header('Location:index.php');

if(isset($_GET['item_id'])){
    $act = Purchase_Logic::get_order($_GET['item_id'],$_SESSION['user']['id']);
}else if(isset($_GET['id'])){
    $act = Purchase_Logic::get_order($_GET['id']);
}else{
    header('Location:index.php');
}

$data = $act['data'];

if($data['seller_id'] == $_SESSION['user']['id'] ){
    $seller_flg = true;
    $info_user_id = $data['buyer_id'];
}else if($data['buyer_id'] == $_SESSION['user']['id']){
    $seller_flg = false;
    $info_user_id = $data['seller_id'];
}

/* 左 */
$days = ['1日以内','3日以内','1週間以内','2週間以内','1ヶ月以内','1ヶ月以上'];
if($seller_flg){
    $left_output  = "<div class='info_box'><div class='left_subject'>購入者</div><div class='text'>{$data['buyer_name']}</div></div>";
}else{
    $left_output  = "<div class='info_box'><div class='left_subject'>出品者</div><div class='text'>{$data['seller_name']}</div></div>";
}

$left_output .= "<a class=''><div class='info_box'><div class='left_subject'>商品名</div><div class='text'>{$data['item_name']}</div></div>";
$left_output .= "<div class='info_box' id='item_info'><div class='item_image'><img src='img/item/{$data['image']}'></div><div class='inner_frame'><div class='inner_box'>￥{$data['price']}</div>";
$left_output .= "<div class='inner_box'>購入日:{$data['buy_date']}</div><div class='inner_box'>発送目安:{$days[$data['days']]}</div></div></div></a>";
$left_output .= "<div class='info_box'><div class='left_subject'>郵便番号</div><div class='text'>{$data['post']}</div><div class='left_subject'>届け先住所</div><div class='text'>{$data['address']}</div></div>";
$left_output .= "<div class='info_box' id='under_box'><div class='left_subject'>取引情報</div><div class='text'>この商品はキャンセルできません</div></div>";

if($seller_flg){
    $right_come_btn = 'id="seller_btn"'; 
    if($act['flgs']['send']){
        $right_btn = "<a href='order_act.php?mode=0&id={$data['id']}'><button class='send' id='seller_btn'>発送を通知</button></a>";        
    }else if($act['flgs']['recived']){
        $right_btn = "<a><button class='send' id='seller_btn'>受け取り待ち</button></a>";
    }else if($act['flgs']['completion']){
        $right_btn = "<a><button class='send' id='seller_btn'>取引は完了しました</button></a>";
    }else{
        $right_btn = "<a><button class='send' id='seller_btn'>取引はキャンセルされました</button></a>";
    }
}else{
    $right_come_btn = '';
    if($act['flgs']['send']){
        $right_btn = "<a><button class='send' id='buyer_btn'>発送待ち</button></a>";        
    }else if($act['flgs']['recived']){
        $right_btn = "<a href='order_act.php?mode=1&id={$data['id']}'><button class='send' id='buyer_btn'>受け取りを通知</button></a>";
    }else if($act['flgs']['completion']){
        $right_btn = "<a><button class='send' id='buyer_btn'>取引は完了しました</button></a>";
    }else{
        $right_btn = "<a><button class='send' id='buyer_btn'>取引はキャンセルされました</button></a>";
    }
}

/* 右 */

$comments = '';

$act = Comment_Logic::get_order_comment($data['id']);

if($act['check'] && !is_bool($act['data'])){

    foreach($act['data'] as $comment){

        $comment_box  = "<div class='comment_info'><div class='comment_name'>{$comment['nick_name']}</div>";
        $comment_box .= "<div class='comment_right_box'><div class='comment_date'>{$comment['created']}</div></div></div>";
        // $comment_box .= "<div class='comment_report'>通報</div></div></div>";
        $comment_box .= "<div class='comment_content'>{$comment['contents']}</div>";
    
        $comments .= "<div class='comment_box'>{$comment_box}</div>";
    }    

}else{
  
    $comment_box  = "<div class='comment_info'><div class='comment_name'>コメントしたユーザーのニックネーム</div>";
    $comment_box .= "<div class='comment_right_box'><div class='comment_date'>0分前</div></div></div>";
    // $comment_box .= "<div class='comment_report'>通報</div></div></div>";
    $comment_box .= "<div class='comment_content'>ここにコメントが表示されます。<br>最初のコメントを送信してみましょう。</div>";

    $comments .= "<div class='comment_box'>{$comment_box}</div>";
    
}




$page_css = 'order';
require_once 'header.php';
?>


<div class="contents">
    <div class="left_right">
        
        <div class="left_side">
            <div class="left_back">
                <?php echo $left_output; ?>
            </div>
        </div>
        <div class="right_side">
            <div class="send_btn">
                <?php echo $right_btn; ?>
            </div>
            <div class="comment_list_frame">
                <div class="right_subject">取引メッセージ</div>
                <div class="comment_list_box">
                    <?php echo $comments; ?>
                </div>
            </div>
        <div class="comment_input_frame">
            <form action="order_comment_act.php" method="post">
                <input type="hidden" name='order_info[user_id]' value="<?php echo $info_user_id; ?>">
                <input type="hidden" name='order_info[item_id]' value="<?php echo $data['item_id']; ?>">
                <input type="hidden" name='order_info[item_name]' value="<?php echo $data['item_name']; ?>">

                <div class="comment_btn_frame">
                    <button class="comment_btn" <?php echo $right_come_btn ?> name="comment[order_id]" value="<?php echo $data['id'];?>">メッセージを送信</button>
                </div>
                    <div class="comment_input_box"><textarea name='comment[contents]' maxlength="255" required></textarea></div>
            
                    </div>
            </form> 
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>
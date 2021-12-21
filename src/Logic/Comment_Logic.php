<?php

require_once 'Validation/Special_Val.php';
require_once 'Ex/User_Ex.php';
require_once 'Ex/Comment_Ex.php';
require_once 'Ex/Info_Ex.php';

class Comment_Logic{

    public static function get_order_comment($order_id)
    {

        $comment_ex = new Comments_Ex();

        $comment_act = $comment_ex->get_order_comment($order_id);

        if(is_bool($comment_act['data'])) return $comment_act;
        if(!is_array($comment_act['data'])) $comment_act['data'] = [$comment_act['data']];

        date_default_timezone_set('Asia/Tokyo');
        $datetime_ins = new DateTime();
        $now = $datetime_ins->format('Y:m:d:H:i:s');

        $word = ['年前','ヶ月前','日前','時間前','分前','秒前'];

        if(is_array($comment_act['data'])){
            if(array_values($comment_act['data']) !== $comment_act['data']) {
                $comment_act['data'] = [$comment_act['data']]; 
            }
        }

        for($j=0; $j<count($comment_act['data']); $j++){
            
            $past = str_replace(['-',' '],':',$comment_act['data'][$j]['created']);
            $past_material = explode(':',$past);
            $now_material = explode(':',$now);

            $material = [];

            $comment_act['data'][$j]['contents'] = nl2br($comment_act['data'][$j]['contents']);

            for($i=0; $i<6; $i++){
                $material[$i] =  $now_material[$i] - $past_material[$i];
                if($material[$i]>0 || $i==5){
                    $comment_act['data'][$j]['created'] = $material[$i].$word[$i];
                    break;
                }
            }

        }

        return $comment_act;

    }

    public static function add_order_comment($data,$info){

        $comment_ex = new Comments_Ex();
        $info_ex = new Info_Ex();

        $act = $comment_ex->add_order_comment($data);

        if(!$act['check']) return $act;

        $subject = "取引中の「{$info['item_name']}」にメッセージが届きました";
        $links = ":order.php?item_id={$info['item_id']}";

        $contents = "取引中の商品にメッセージが届きました。\n取引ページを確認してください。\n#:links:「{$info['item_name']}」取引ページへ:end:#";
        
        $act = $info_ex->add($info['user_id'],$subject,$links,$contents);

        return $act;

    }

}

?>
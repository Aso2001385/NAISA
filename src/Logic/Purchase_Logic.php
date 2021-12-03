<?php

require_once 'Validation/basicValidation.php';

/* 購入系 */
class Purchase_Logic{

    /* + 表示系 + */

    /* 商品一覧 */
    public static function item_list(){

        require_once 'Ex/Item_Ex.php';

        $item_ex = new Item_Ex();
        $data = $item_ex->get_multi();
   
        $output = '';
        if($data['check']){

            foreach($data['data'] as $record){

                $image_tag  = "<div class='item_image'><img class='img' src='/image/item/{$record['image']}'alt='商品画像'></img></div>";
                $item_name  = "<div class'item_status'><div class='item_name'>{$record['name']}</div>";
                $item_price = "<div class='item_price'>¥{$record['price']}</div></div>";
    
                $item_block  = "<div onclick='DivFrameClick({$record['id']})'>";
                $item_block .= $image_tag.$item_name.$item_price.'</div>';

                $output .= $item_block;

            }

        }

        return [
            'list' => $output
        ];

    }

    /* 商品詳細 */
    public static function item_detail($id){

        require_once 'Ex/Item_Ex.php';
        require_once 'Ex/User_Ex.php';
        require_once 'Ex/Comment_Ex.php';

        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $come_ex = new Comments_Ex();
        $item_data   = $item_ex->get_singul($id);
        $seller_data = $user_ex->get_singul($item_data['data']['id']);
        $item_come   = $come_ex->get_item_comment($id);


        return [
            'item' => $item_data['data'],
            'seller' => $seller_data['data'],
            'come' => $item_come['data']
        ];
    
    }

    /* 商品購入 */
    public static function buy($id){

        require_once 'Ex/Item_Ex.php';
        require_once 'Ex/User_Ex.php';

        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();

        $item_data   = $item_ex->get_singul($id);
        $user_data = $user_ex->get_singul($item_data['data']['id']);
        
        if($item_data['data']['start'] === NULL){
            $start_flg = true;
        }else{
            $start_flg = false;
        }

        return [
            'data' => $item_data['data'],
            'data' => $seller_data['data'],
            'start_flg' => $start_flg
        ];
    
    }

    /* 取引 */
    public static function order($id,$user_id=0){

        require_once 'Ex/Order_Ex.php';
        require_once 'Ex/Item_Ex.php';
        require_once 'Ex/User_Ex.php';
        require_once 'Ex/Comment_Ex.php';
        
        $order_ex = new Order_EX();
        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $come_ex = new Comments_Ex();
        
        if($user_id = 0){
            $order_data = $order_ex->get_singul($id);
        }else{
            $order_data = $order_ex->get_singul($id,$user_id);
        }
        
        $item_data   = $item_ex->get_singul($order_data['data']['item_id']);
        $user_data = $user_ex->get_singul($item_data['data']['id']);
        $item_come   = $come_ex->get_order_comment($id);
        
        $flgs = [
            'send' => $order_data['data']['send'] === NULL,
            'recived' => $order_data['data']['recived'] === NULL,
            'completion' => $order_data['data']['completion'] === NULL,
            'stop' => $order_data['data']['stop'] === NULL,
        ];

        return [
            'order' => $order_data['data'],
            'item' => $item_data['data'],
            'user' => $user_data['data'],
            'flgs' => $flgs
        ];
    
    }

}

    /*

    商品一覧用データセット
    Purchase_Logic::list();

    アイテム詳細用データセット
    Purchase_Logic::item_detail(アイテムID);
        'item_data' >>> 商品データ
        'seller_data' >>>  販売者データ
        'item_come' >>> コメントデータ

    


    */

?>

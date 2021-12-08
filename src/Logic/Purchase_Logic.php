<?php

require_once 'Validation/Special_Val.php';
require_once 'Ex/Item_Ex.php';
require_once 'Ex/User_Ex.php';
require_once 'Ex/Comment_Ex.php';
require_once 'Ex/Order_Ex.php';

/* 購入系 */
class Purchase_Logic{

    /* 
    表示系 + 
    操作系 -
    */

    /* 商品一覧 + */
    public static function item_list()
    {

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

    /* 商品検索 */
    public static function item_search($search_word)
    {

        $item_ex = new Item_Ex();

        $item_data = $item_ex->search($search_word);

        $output = '';
        if($item_data['check']){

            foreach($item_data['data'] as $record){

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

    /* 商品詳細 + */
    public static function item_detail($id)
    {

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

    /* 商品購入 + */
    public static function buy($id)
    {

        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();

        $item_data   = $item_ex->get_singul($id);
        if($item_data['data']['user_id'] == $_SESSION['user_data']['id']){
            //リダイレクト
        }
        $user_data = $user_ex->get_singul($item_data['data']['id']);
        
        if($item_data['data']['start'] !== NULL){
            //リダイレクト処理
        }

        return [
            'item' => $item_data['data'],
            'seller' => $seller_data['data'],
        ];
    
    }

    /* 商品購入処理 - */
    public static function buy_act($data)
    {

        /*  */
        
        
        

        $order_ex = new Order_Ex();
        $item_ex = new Item_Ex();

        /* 商品データ取得 */
        $item_data = $item_ex->get_singul($data['id']);
        
        /* 取引可能かチェック */
        if($item_data['data']['start'] !== NULL){
            //リダイレクト
        }

        /* 取引開始日時を記録 */
        $datetime_ins = new DateTime();
        $datetime = $datetime_ins->format('Y-m-d H:i:s');
        $act = $item_ex->update(['start'=>$datetime],$id);
        if($act['check']){
            //リダイレクト
        }
        $act = $order_ex->add($data);
        /* 取引テーブルにレコード追加 */
        if($act['check']){
            //リダイレクト
        }
        
        return [
            'item' => $item_data['data'],
            'seller' => $seller_data['data'],
            'flg' => $start_flg
        ];
    
    }

    /* 取引 + */
    public static function order($id,$user_id=0)
    {
        
        $order_ex = new Order_Ex();
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
        $order_come   = $come_ex->get_order_comment($order_data['data']['order_id']);
        
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
            'come' => $order_come,
            'flgs' => $flgs
        ];
    
    }


    /* 受け取り通知処理 */
    public static function order_recived_notic($id,$user_id)
    {

        
        
        
        $order_ex = new Order_Ex();
        $order_data = $order_ex->get_singul($id);

        /* 発送通知が既に入っていないかチェック */
        if($order_data['data']['recived'] === NULL){

            /* ユーザーが正しいかチェック */
            if($order_data['data']['user_id'] == $user_id){
                $datetime_ins = new DateTime();
                $datetime = $datetime_ins->format('Y-m-d H:i:s');
                $order_ex->update(['id'=>$id,'recived'=>$datetime]);
            }else{
                //リダイレクト
            }
            
        }else{
            //リダイレクト
        }

        //リダイレクト：完了処理

    }

    /* キャンセル処理 */
    public static function order_cancel($id)
    {

        
        
        
        $order_ex = new Order_Ex();
        $item_ex = new Item_Ex();
        
        $order_data = $order_ex->get_singul($id);

        /* 発送通知が既に入っていないかチェック */
        if($order_data['data']['send'] === NULL){

            $datetime_ins = new DateTime();
            $datetime = $datetime_ins->format('Y-m-d H:i:s');
            $order_ex->update(['id'=>$id,'send'=>$datetime]);

        }else{
            //リダイレクト
        }

        //リダイレクト

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

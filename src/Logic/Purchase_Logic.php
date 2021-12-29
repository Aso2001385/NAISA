<?php

require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Validation/Special_Val.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Validation/Validation.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Item_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/User_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Comment_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Order_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Card_Ex.php';


/* 購入系 */
class Purchase_Logic{

    /* 
    表示系 + 
    操作系 -
    */

    /* 商品一覧 + */
    public static function item_list($page)
    {

        $item_ex = new Item_Ex();

        $page *= 24; 
        $act = $item_ex->get_multi($page);
        
        if(is_array($act['data'])){
            if(array_values($act['data']) !== $act['data']) {
                $act['data'] = [$act['data']]; 
            }
        }
        
        return $act;

    }

    /* 商品検索 */
    public static function item_search($search_word,$page)
    {

        $item_ex = new Item_Ex();
        $page *= 24; 

        $checkData = Validation::creat()->input($search_word)
        ->charType(1,1,1,0,1,1,1)
        ->toLENGTH(1,50)
        ->toEXECUTE();

        if(!$checkData['check']) return [ 'check' => false, 'data' => false ];


        $act = $item_ex->search($search_word,$page);
        $fusion = [];
        if(is_bool($act['data'])) return $act;
        if(is_array($act['data'])){
            if(array_values($act['data']) !== $act['data']) {
                $act['data'] = [$act['data']]; 
            }
        }

        foreach($act['data'] as $item){
            if($item['start'] === NULL && $item['deleted'] === NULL){
                $fusion[count($fusion)] = $item;
            }
        }

        return [
            'check' => $act['check'],
            'data' => $fusion
        ];

    }

    /* 商品詳細 + */
    public static function item_detail($id)
    {

        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $come_ex = new Comments_Ex();
        $item_data   = $item_ex->get_singul($id);
        $seller_data = $user_ex->get_singul($item_data['data']['user_id']);
        $item_come   = $come_ex->get_item_comment($id);

        return [
            'item' => $item_data['data'],
            'seller' => $seller_data['data'],
            'come' => $item_come
        ];
    
    }

    public static function detail_get_order($item_id){
        $order_ex = new Order_Ex();

        $act = $order_ex->get_by_item_id($item_id);

        return $act;
    }

    public static function card_rigister($card_data,$user_id){

        $card_ex = new Card_Ex();

        $card_data =  array_merge($card_data,array('user_id'=>$user_id));

        $act = $card_ex->add($card_data);

        return $act['check'];

    }

    public static function get_card($user_id){
        
        $card_ex = new Card_Ex();
        $act = $card_ex->get_multi($user_id);
        if(!$act['check'] || !$act['data']) return ['check' => false];

        if(!isset($act['data'][0])) $act['data'] = [$act['data']];

        $card = $act['data'];
        for($i=0; $i<count($card); $i++){
            $code = $card[$i]['code'];
            $card[$i]['code'] = substr_replace($code,str_repeat('*',strlen($code)-4),0,strlen($code)-4);
            unset($card[$i]['user_id']);  
            unset($card[$i]['month']);
            unset($card[$i]['year']);
            unset($card[$i]['security']);
            unset($card[$i]['created']);
            unset($card[$i]['deleted']);
        }

        return [
            'check' => true,
            'data' => $card   
        ];

    }

    public static function get_new_card($user_id){
        $card_ex = new Card_Ex();
        $act = $card_ex->get_new_single($user_id);
        if(!$act['check'] || !$act['data']) return ['check' => false];

        if(!isset($act['data'][0])) $act['data'] = [$act['data']];

        $card = $act['data'];
        for($i=0; $i<count($card); $i++){
            $code = $card[$i]['code'];
            $card[$i]['code'] = substr_replace($code,str_repeat('*',strlen($code)-4),0,strlen($code)-4);
            unset($card[$i]['user_id']);  
            unset($card[$i]['month']);
            unset($card[$i]['year']);
            unset($card[$i]['security']);
            unset($card[$i]['created']);
            unset($card[$i]['deleted']);
        }

        return [
            'check' => true,
            'data' => $card   
        ];

    }

    /* 商品購入 + */
    public static function buy($id)
    {

        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();

        $item_data   = $item_ex->get_singul($id);
        if($item_data['data']['user_id'] == $_SESSION['user_data']['id']){
            header("Location:item_detail.php?item_id={$id}");
        }
        $user_data = $user_ex->get_singul($item_data['data']['id']);
        
        if($item_data['data']['start'] !== NULL){
            header("Location:item_detail.php?item_id={$id}");
        }

        return [
            'item' => $item_data['data'],
            'seller' => $seller_data['data'],
        ];
    
    }

    /* 商品購入処理 - */
    public static function buy_act($data)
    {

        $order_ex = new Order_Ex();
        $item_ex = new Item_Ex();

        /* 商品データ取得 */
        $item_data = $item_ex->get_singul($data['item_id']);
        
        /* 取引可能かチェック */
        if($item_data['data']['start'] !== NULL){
            return [
                'check' => false,
                'flg' => true
            ];
        }
        
        $act = $order_ex->add($data);  

        /* 取引開始日時を記録 */
        $datetime_ins = new DateTime();
        $datetime = $datetime_ins->format('Y-m-d H:i:s');
        $act = $item_ex->update(['start'=>$datetime],$data['item_id']);
        
        return [
            'check' => $act['check'],
            'flg' => false
        ];
    
    }

    /* 取引 + */
    public static function get_order($id,$user_id=0)
    {
        
        $order_ex = new Order_Ex();
        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $come_ex = new Comments_Ex();
        
        if($user_id == 0){
            // order_idで取得
            $order_data = $order_ex->get_singul($id);
            
        }else{
            // item_idと購入者idで取得
            $order_data = $order_ex->get_singul($id,$user_id);

        }
        
        $item_data   = $item_ex->get_singul($order_data['data']['item_id']);
        $seller_data = $user_ex->get_singul($item_data['data']['user_id']);
        $buyer_data = $user_ex->get_singul($order_data['data']['user_id']);
        $order_come   = $come_ex->get_order_comment($order_data['data']['id']);
        $order_data = $order_data['data'];
        $item_data = $item_data['data'];
        $seller_data = $seller_data['data'];
        $buyer_data =  $buyer_data['data'];

        $fusion_data = [
            'id' => $order_data['id'],
            'seller_id' => $seller_data['id'],
            'seller_name' => $seller_data['nick_name'],
            'buyer_id' => $buyer_data['id'],
            'buyer_name' => $buyer_data['name'],
            'item_id' => $item_data['id'],
            'item_name' => $item_data['name'],
            'image' => $item_data['image'],
            'price' => $item_data['price'],
            'buy_date' => $order_data['created'],
            'days' => $item_data['delivery_days'],
            'post' => $order_data['post'],
            'address' => $order_data['address'],
        ];

        
        $flgs = [
            'send' => $order_data['send'] === NULL,
            'recived' => $order_data['recived'] === NULL,
            'completion' => $order_data['completion'] === NULL,
            'stop' => $order_data['stop'] === NULL,
        ];

        return [
            'data' => $fusion_data,
            'come' => $order_come,
            'flgs' => $flgs
        ];
    
    }

    public static function order_list($user_id){

        $item_ex  = new Item_Ex();

        $act = $item_ex->get_order_multi($user_id);
        $fusion = [];

        if(is_bool($act['data'])) return $fusion;
        if(array_values($act['data']) !== $act['data']) $act['data'] = [$act['data']];   

        foreach($act['data'] as $row){

            $item = [
                'item_id' => $row['id'],
                'image' => $row['image'],
                'name' => $row['name'],
                'price' => $row['price']
            ];
     

            if($row['start'] !== NULL){
                $fusion[count($fusion)] = $item; 
            }

        }

        return $fusion;
        
    }


    /* 受け取り通知処理 */
    public static function order_recived_notic($id,$user_id)
    {
        
        $order_ex = new Order_Ex();
        $order_data = $order_ex->get_singul($id);

        /* 発送通知が既に入っていないかチェック */
        if($order_data['data']['recived'] === NULL){

            /* ユーザーが正しいかチェック */
      
            $datetime_ins = new DateTime();
            $datetime = $datetime_ins->format('Y-m-d H:i:s');
            $order_ex->update(['id'=>$id,'recived'=>$datetime]);
            
            
        }else{
            //リダイレクト
        }

        

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

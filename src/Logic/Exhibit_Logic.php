<?php

require_once 'Validation/basicValidation.php';

class Exhibit_Logic{

    /* 商品登録処理 */
    public static function item_register($item_data)
    {

        require_once 'Ex\Item_Ex.php';
        $item_ex = new Item_Ex();

        $act = $item_ex->add($item_data);

    }

    /* 登録した商品の確認(商品詳細) */
    public static function item_comfirm($user_id)
    {

        require_once 'Ex/Item_Ex.php';
        require_once 'Ex/User_Ex.php';
        require_once 'Ex/Comment_Ex.php';

        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $come_ex = new Comments_Ex();
        $item_data   = $item_ex->get_new_singul($user_id);
        $seller_data = $user_ex->get_singul($item_data['data']['id']);
        $item_come   = $come_ex->get_item_comment($id);

        return [
            'item' => $item_data['data'],
            'seller' => $seller_data['data'],
            'come' => $item_come['data']
        ];

    }

    /* 登録商品の一覧 */
    public static function item_list($user_id){

        require_once 'Ex/Item_Ex.php';

        $item_ex = new Item_Ex();
        $data = $item_ex->get_user_multi($user_id);
   
        return [
            'list' => $output
        ];

    }

    /* 登録商品の編集処理 */
    public static function item_edit($item_data,$item_id,$user_id)
    {

        require_once 'Ex/Item_Ex.php';

        $item_ex = new Item_Ex();
        $act = $item_ex->get_singul($item_id);
    
        if($act['data']['user_id'] == $user_id){
            $act = $item_ex->update($item_data,$item_id);
        }else{
            //リダイレクト
        }

    }

    /* 登録商品の削除処理 */
    public static function item_delete($item_id)
    {
        require_once 'Ex/Item_Ex.php';

        $item_ex = new Item_Ex();
        $act = $item_ex->get_singul($item_id);
    
        if($act['data']['user_id'] == $user_id){
            $act = $item_ex->delete($item_id);
        }else{
            //リダイレクト
        }
    }


    /* 発送通知処理 */
    public static function order_send_notic($id,$user_id)
    {

        require_once 'Ex/Order_Ex.php';
        require_once 'Ex/Item_Ex.php';
        
        $order_ex = new Order_Ex();
        $item_ex = new Item_Ex();
        
        $order_data = $order_ex->get_singul($id);

        /* 発送通知が既に入っていないかチェック */
        if($order_data['data']['send'] === NULL){

            /* ユーザーが正しいかチェック */
            $item_data = $item_ex->get_singul($order_data['data']['item_id']);

            if($item_data['data']['user_id'] == $user_id){

                $datetime_ins = new DateTime();
                $datetime = $datetime_ins->format('Y-m-d H:i:s');
                $order_ex->update(['id'=>$id,'send'=>$datetime]);

            }else{
                //リダイレクト
            }

        }else{
            //リダイレクト
        }

        //リダイレクト

    }

}

?>
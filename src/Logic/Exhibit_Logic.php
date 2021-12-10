<?php

class Exhibit_Logic{

    /* 画像仮登録 */
    public static function tmp_image_add($image_post)
    {

        try{
          
            if(!file_exists('img/tmp_item')){
                mkdir('img/tmp_item');
            }
            $rand_word = '';
            for($i=0; $i<6; $i++){
                $rand_word .= chr(mt_rand(97,122));
            }
            
            switch($image_post['type']){

                case 'image/jpeg':
                    $tmp_image_name = 'img/tmp_item/'.basename($rand_word.'.jpg');
                    break;
                case 'image/png':
                    $tmp_image_name = 'img/tmp_item/'.basename($rand_word.'.png');
                    break;
            }

            if(!move_uploaded_file($image_post['tmp_name'],$tmp_image_name)){
                return [
                    'check' => false,
                ];
            }


            return [
                'check' => true,
                'tmp_image_name' => $tmp_image_name,
                'tmp_image_type' => $image_post['type'],
            ];

            

        }catch(Exception $e){
            return [
                'check' => true,
            ];
        }
        
    }

    /* 画像登録(フォルダに)処理 */
    public static function image_download($tmp_image_name,$tmp_image_type,$size)
    {

        try{
          
            switch($tmp_image_type){

                case 'image/jpeg':
                    $baseimage = imagecreatefromjpeg($tmp_image_name);
                    break;
                case 'image/png':
                    $baseimage = imagecreatefrompng($tmp_image_name);
                    break;
            }
          
            list($width,$hight) = getimagesize($tmp_image_name);
            $reduced_hight = $hight;
            $reduced_width = $width;
            
            if($reduced_hight < $reduced_width){
                $divide = $reduced_width / $size;
            }else{
                $divide = $reduced_hight / $size;
            }
            
            $reduced_width = $reduced_width / $divide;
            $reduced_hight = $reduced_hight / $divide; 
            
            $image = imagecreatetruecolor($reduced_width,$reduced_hight);
            imagecopyresampled($image,$baseimage,0,0,0,0,$reduced_width,$reduced_hight,$width,$hight);

            $user_id = $_SESSION['user']['id'];
            $sale_count = $_SESSION['user']['sale_count'] + 1;

            $image_name = 'item_'.str_pad($user_id,4,0,STR_PAD_LEFT).str_pad($sale_count,4,0,STR_PAD_LEFT).'.png';

            imagepng($image,'img/item/'.$image_name);

            if(!unlink($tmp_image_name)){
                return [
                    'check' => false,
                ];
            }

            return [
                'check' => true,
                'image_name' => $image_name
            ];

            

        }catch(Exception $e){
            return [
                'check' => true,
            ];
        }
        
    }

    /* 商品登録処理 */
    public static function item_register($item_data,$image_name,$user_id)
    {
        
        require_once 'Ex\Item_Ex.php';
        $item = array_merge($item_data,['image'=>$image_name,'user_id'=>$user_id]);
        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $act = $item_ex->add($item);

        if($act['check']){

            $_SESSION['user']['sale_count'] = $_SESSION['user']['sale_count'] + 1;

            unset($_SESSION['user']['created']);
            unset($_SESSION['user']['updated']);
            unset($_SESSION['user']['deleted']);

            $act = $user_ex->update($_SESSION['user']);

        }else{

        }

        return $act['check'];

    }
    

    /* 登録した商品の確認(商品詳細) */
    public static function item_comfim($user_id)
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
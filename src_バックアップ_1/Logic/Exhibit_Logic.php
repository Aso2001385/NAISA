<?php
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Validation/Special_Val.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Item_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/User_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Comment_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Order_Ex.php';
require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/Card_Ex.php';
class Exhibit_Logic{

    /* 画像仮登録 */
    public static function tmp_image_add($image_post)
    {

        try{
          
            if(!file_exists('/home/users/2/versus.jp-aso2001385/web/NAISA/img/tmp_item')){
                mkdir('/home/users/2/versus.jp-aso2001385/web/NAISA/img/tmp_item');
            }
            $rand_word = '';
            for($i=0; $i<6; $i++){
                $rand_word .= chr(mt_rand(97,122));
            }
            
            switch($image_post['type']){

                case 'image/jpeg':
                    $tmp_image_name = '/home/users/2/versus.jp-aso2001385/web/NAISA/img/tmp_item/'.basename($rand_word.'.jpg');
                    break;
                case 'image/png':
                    $tmp_image_name = '/home/users/2/versus.jp-aso2001385/web/NAISA/img/tmp_item/'.basename($rand_word.'.png');
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
                'check' => false,
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
            
            $reduced_width = round($reduced_width / $divide,0);
            $reduced_hight = round($reduced_hight / $divide,0); 
            
            $image = imagecreatetruecolor($size,$size);
            $white = imagecolorallocate($image,255,255,255);
            imagefill($image,0,0,$white);
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
                'check' => false,
            ];
        }
        
    }

    public static function image_edit($tmp_image_name,$tmp_image_type,$size,$now_image_name)
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
            
            $reduced_width = round($reduced_width / $divide,0);
            $reduced_hight = round($reduced_hight / $divide,0); 
            
            $image = imagecreatetruecolor($size,$size);
            $white = imagecolorallocate($image,255,255,255);
            imagefill($image,0,0,$white);
            imagecopyresampled($image,$baseimage,0,0,0,0,$reduced_width,$reduced_hight,$width,$hight);

            unlink('img/item/'.$now_image_name);

            imagepng($image,'img/item/'.$now_image_name);

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
                'check' => false,
            ];
        }
        
    }

    /* 商品登録処理 */
    public static function item_register($item_data,$image_name,$user_id)
    {
        
        $item = array_merge($item_data,['image'=>$image_name,'user_id'=>$user_id]);
        $item_ex = new Item_Ex();
        $user_ex = new User_Ex();
        $item_act = $item_ex->add($item);

        if($item_act['check']){

            $_SESSION['user']['sale_count'] = $_SESSION['user']['sale_count'] + 1;

            unset($_SESSION['user']['created']);
            unset($_SESSION['user']['updated']);
            unset($_SESSION['user']['deleted']);

            $item_act = $user_ex->update($_SESSION['user']);

        }else{

        }

        return $item_act['check'];

    }
    

    /* 登録した商品の確認(商品詳細) */
    public static function item_confirm($user_id)
    {

        $item_ex = new Item_Ex();
        $come_ex = new Comments_Ex();
        $item_data   = $item_ex->get_new_singul($user_id);
        $item_come   = $come_ex->get_item_comment($item_data['data']['id']);

        return [
            'item' => $item_data['data'],
            'come' => $item_come['data']
        ];

    }

        /* 登録商品の編集処理 */
        public static function item_edit($item_data,$image_name,$item_id,$user_id)
        {
    
            $item_ex = new Item_Ex();
            $item_act = $item_ex->get_singul($item_id);
        
            if($item_act['data']['user_id'] == $user_id){
                $item = array_merge($item_data,['image'=>$image_name,'user_id'=>$user_id]);
                $item_act = $item_ex->update($item,$item_id);
            }else{
                unset($_SESSION['tmp_image_name']);
                unset($_SESSION['tmp_image_type']);
                header('Location:index.php');
            }
    
        }

    /* 登録商品の一覧 */
    public static function exhibit_list($user_id){

        $item_ex  = new Item_Ex();
        $order_ex = new Order_Ex();

        $fusion = [[],[],[],[]];

        /* 商品一覧取得 */
        $item_act  = $item_ex->get_user_multi($user_id);

        $order_act = $order_ex->get_by_seller_id($user_id);

        if(!is_bool($item_act['data'])){
            if(array_values($item_act['data']) !== $item_act['data']) $item_act['data'] = [$item_act['data']]; 
        }else{
            return $fusion;
        }


        if(!is_bool($order_act['data'])){
            if(array_values($order_act['data']) !== $order_act['data']) $order_act['data'] = [$order_act['data']]; 
        }

        foreach($item_act['data'] as $row){
            
           
            $item = [
                'item_id' => $row['id'],
                'image' => $row['image'],
                'name' => $row['name'],
                'price' => $row['price']
            ];
     
            /* 取引されていないか */
            if($row['start'] === NULL){
                $fusion[1][count($fusion[1])] = $item;
            }else{
                if(!is_bool($order_act['data'])){
                    foreach($order_act['data'] as $ord){
                        /* レコード照合 */
                        if($item['item_id'] == $ord['item_id']){
                            
                            /* 完了しているか */
                            if($ord['completion'] !== NULL){
                                $fusion[2][count($fusion[2])] = $item; 
                            /* 取引中か */
                            }else if($ord['stop'] === NULL){
                                $fusion[0][count($fusion[0])] = $item;
                            }else{
                                $fusion[3][count($fusion[3])] = $item;
                            }
                        }
                    }
                    unset($item);
                }
            }
        }

        return $fusion;

    }



    /* 登録商品の削除処理 */
    public static function item_delete($item_id,$user_id)
    {
        $item_ex = new Item_Ex();
        $item_act = $item_ex->get_singul($item_id);
    
        if($item_act['data']['user_id'] == $user_id){
            $item_act = $item_ex->delete($item_id);
        }else{
            return false;
        }

        return $item_act['check'];
    }


    /* 発送通知処理 */
    public static function order_send_notic($id,$user_id)
    {

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
                $item_act = $order_ex->update(['id'=>$id,'send'=>$datetime]);

            }else{
                return ['check' => false];
            }

        }else{
            return ['check' => false];
        }
        return $item_act;
        //リダイレクト

    }

}

?>
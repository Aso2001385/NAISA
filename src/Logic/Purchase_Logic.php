<?php

require_once 'Validation/basicValidation.php';

class Purchase_Logic{

    /* 商品一覧 */
    public static function item_list(){

        require_once 'Ex/Item_Ex.php';

        $item_ex = new Item_Ex();
        $data = $item_ex->get_multi();
   
        $output = '';
        if($data['check']){

            foreach($data['data'] as $record){

                $image_tag  = "<div class='item_image'><img class='img' src='/image/item/{$record['image']}'alt='商品画像'></img></div>";
                $item_name  = "<div class='item_name'>{$record['name']}</div>";
                $item_price = "<div class='item_price'>¥{$record['price']}</div>";
    
                $item_block  = "<div onclick='DivFrameClick({$record['id']})'>";
                $item_block .= $image_tag.$item_name.$item_price.'</div>';

                $output .= $item_block;

            }

        }

        return [
            'item_list' => $output
        ];

    } 

}

    Purchase_Logic::item_list();

?>

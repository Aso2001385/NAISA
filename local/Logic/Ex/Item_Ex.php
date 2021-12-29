<?php

require_once 'DB_Function.php';

/*

id
user_id
category_id
name
name_read
image
price
quality
delivery_method
delivery_fee
delivery_days
delivery_prefecture
description
comment_count
created
updated
deleted

*/

class Item_Ex
{

    private $main = 'item';

    /* 商品データ複数取得 */
    public function get_multi($start,$limit = 25)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('deleted','IS',NULL)
            ->toAND('start','IS',NULL)
            ->toDESC('id')
            ->toLIMIT($start,$limit)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            if($act['check']){
                return [
                    'check' => true,
                    'data' => $act['data']
                ];
            }else{
                return [
                    'check' => false
                ];
            }

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    
    public function search($word,$start,$limit = 25){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('name','%:%',$word)
            ->toOR('description','%:%',$word)
            ->toDESC('id')
            ->toLIMIT($start,$limit)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    /* 商品データ単体取得 */
    public function get_singul($item_id){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('id','=',$item_id)
            ->toAND('deleted','IS',NULL)
            ->toLIMIT(1)
            ->toEXECUTE(PDO::FETCH_ASSOC);
            
            if($act['check']){
                return [
                    'check' => true,
                    'data' => $act['data']
                ];
            }else{
                return [
                    'check' => false
                ];
            }


        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

        /* 指定最新商品データ単体取得 */
        public function get_new_singul($user_id){

            try{
    
                $act = DB_function::create($this->main)
                ->connect('naisa')
                ->toSELECT()
                ->toWHERE('user_id','=',$user_id)
                ->toAND('deleted','IS',NULL)
                ->toDESC('id')
                ->toLIMIT(1)
                ->toEXECUTE(PDO::FETCH_ASSOC);
    
                if($act['check']){
                    return [
                        'check' => true,
                        'data' => $act['data']
                    ];
                }else{
                    return [
                        'check' => false
                    ];
                }
    
    
            }catch(Exception $ex){
    
                return [
                    'check' => false
                ];
    
            }
        }

    /* 指定ユーザ商品データ複数取得 */
    public function get_user_multi($user_id,$limit = 25){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('user_id','=',$user_id)
            ->toAND('deleted','IS',NULL)
            ->toDESC('id')
            ->toLIMIT($limit)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            if($act['check']){
                return [
                    'check' => true,
                    'data' => $act['data']
                ];
            }else{
                return [
                    'check' => false
                ];
            }


        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }


    /* 商品データ追加 */
    public function add($data){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toINSERT($data)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    /* 商品データ更新 */
    public function update($data,$id){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toUPDATE($data)
            ->toWHERE('id','=',$id)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            if($act['check']){
                return [
                    'check' => true,
                ];
            }else{
                return [
                    'check' => false
                ];
            }


        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    /* 商品削除(論理削除) */
    public function delete($id){

        try{

            date_default_timezone_set('Asia/Tokyo');
            $datetime_ins = new DateTime();
            $datetime = $datetime_ins->format('Y-m-d H:i:s');
            
            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toUPDATE(['deleted'],[$datetime])
            ->toWHERE('id','=',$id)
            ->toEXECUTE();

            if($act['check']){
                return [
                    'check' => true,
                ];
            }else{
                return [
                    'check' => false
                ];
            }


        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    public function get_order_multi($user_id){

        $act = DB_function::create($this->main)
        ->connect('naisa')
        ->toSELECT()
        ->subWHERE('EXISTS')
        ->toSELECT([],'order')
        ->subconnect('order','id','item_id')
        ->toAND('user_id','=',$user_id,'order')
        ->subEND()
        ->toEXECUTE(PDO::FETCH_ASSOC);

        return $act ;

    }
    

}

?>
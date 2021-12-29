<?php

require_once '/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/DB_Function.php';

/*

id
item_id
user_id
card_id
post
address
send
recived
completion
stop
created
updated

*/

class Order_Ex
{

    private $main = 'order';

    /* 商品データ複数取得 */
    public function get_multi($user_id,$limit = 25)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toSELECT()
            ->toWHERE('user_id','=',$user_id)
            ->toDESC('id')
            ->toLIMIT($limit)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    public function get_by_seller_id($user_id){

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toSELECT()
            ->subWHERE('EXISTS')
            ->toSELECT(['id'],['item'],'item')
            ->subconnect('item','item_id','id')
            ->toAND('user_id','=',$user_id,'item')
            ->subEND()
            ->toDESC('id')
            ->toLIMIT(1)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    public function get_by_item_id($item_id){

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toSELECT(['id','user_id'])
            ->toWHERE('item_id','=',$item_id)
            ->toDESC('id')
            ->toLIMIT(1)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    /* 商品データ単体取得 */
    public function get_singul($id,$user_id = 0){

        try{

            if($user_id == 0){

                $act = DB_function::create($this->main)
                ->connect()
                ->toSELECT()
                ->toWHERE('id','=',$id)
                ->toLIMIT(1)
                ->toEXECUTE(PDO::FETCH_ASSOC);

            }else{

                $act = DB_function::create($this->main)
                ->connect()
                ->toSELECT()
                ->toWHERE('item_id','=',$id)
                ->toAND('user_id','=',$user_id)
                ->toLIMIT(1)
                ->toEXECUTE(PDO::FETCH_ASSOC);

            }
    
            return $act;

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
            ->connect()
            ->toSELECT()
            ->toWHERE('user_id','=',$user_id)
            ->toLIMIT($limit)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    /* 取引データ追加 */
    public function add($data){

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toINSERT($data)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'check' => true
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    /* 商品データ更新 */
    public function update($data){

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toUPDATE($data)
            ->toWHERE('id','=',$data['id'])
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'check' => true,
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    /* 商品削除(論理削除) */
    public function delete($id){

        try{

            $datetime_ins = new DateTime();

            $datetime = $datetime_ins->format('Y-m-d H:i:s');
            
            $act = DB_function::create($this->main)
            ->connect()
            ->toUPDATE('deleted',[$datetime_ins])
            ->toWHERE('id','=',$id)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'check' => true,
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    

}

?>
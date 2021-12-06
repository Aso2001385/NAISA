<?php

require_once 'DB_Function.php';

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
    public function get_multi($id,$limit = 25)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('deleted','IS','NULL')
            ->toAND('user_id','=',$id)
            ->toDESC('id')
            ->toLIMIT(25)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'check' => true,
                'data' => $act['data']
            ];

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
                ->connect('naisa')
                ->toSELECT()
                ->toWHERE('id','=',$id)
                ->toAND('deleted','IS','NULL')
                ->toLIMIT(1)
                ->toEXECUTE(PDO::FETCH_ASSOC);

            }else{

                $act = DB_function::create($this->main)
                ->connect('naisa')
                ->toSELECT()
                ->toWHERE('item_id','=',$id)
                ->toAND('user_id','=',$user_id)
                ->toAND('deleted','IS','NULL')
                ->toLIMIT(1)
                ->toEXECUTE(PDO::FETCH_ASSOC);

            }
        
            return [
                'check' => true,
                'data' => $act['data']
            ];

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
            ->toAND('deleted','IS','NULL')
            ->toLIMIT($limit)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'check' => true,
                'data' => $act
            ];

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
            ->connect('naisa')
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
            ->connect('naisa')
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
            ->connect('naisa')
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
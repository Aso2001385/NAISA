<?php

require_once 'DB_Function.php';

class User_Model
{

    private $main = 'user';

    /* ユーザーデータ複数取得 */
    public function get_multi($limit = 25)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('deleted','IS','NULL')
            ->toDESC('id')
            ->toLIMIT(25)
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

    /* 商品データ単体取得 */
    public function get_singul($item_id){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('id','=',$item_id)
            ->toAND('deleted','IS','NULL')
            ->toLIMIT(1)
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

    /* 商品データ追加 */
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
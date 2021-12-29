<?php

require_once 'DB_Function.php';


/*

item_comment/order_comment

id
item_id/order_id
user_id
contents
passive
created
updated
deleted

*/

class Comments_Ex{

    private $item = 'item_comment';
    private $order = 'order_comment';

    public function get_item_comment($item_id)
    {
        

        try{

            $column_name = [
                'id',
                'user_id',
                'name',
                'contents',
                'passive',
                'created',
                'deleted',
            ];

            $table_name = [
                'item_comment',
                'item_comment',
                'user',
                'item_comment',
                'item_comment',
                'item_comment',
                'item_comment',
            ];

            $act = DB_function::create($this->item)
            ->connect('naisa')
            ->toSELECT($column_name,$table_name)
            ->toJOIN('user','user_id','id')
            ->toWHERE('item_id','=',$item_id,'item_comment')
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    public function get_order_comment($order_id)
    {
        try{

            $column_name = [
                'id',
                'user_id',
                'nick_name',
                'contents',
                'created',
                'deleted',
            ];

            $table_name = [
                'order_comment',
                'order_comment',
                'user',
                'order_comment',
                'order_comment',
                'order_comment',
            ];

            $act = DB_function::create($this->order)
            ->connect('naisa')
            ->toSELECT($column_name,$table_name)
            ->toJOIN('user','user_id','id')
            ->toWHERE('order_id','=',$order_id,'order_comment')
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;
        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    public function add_item_comment($data)
    {

        try{

            $act = DB_function::create($this->item)
            ->connect('naisa')
            ->toINSERT($data)
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

    public function add_order_comment($data)
    {

        try{

            $act = DB_function::create($this->order)
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

    public function delete_item_comment($id){

        try{

            $datetime_ins = new DateTime();

            $datetime = $datetime_ins->format('Y-m-d H:i:s');

            $act = DB_function::create($this->item)
            ->connect('naisa')
            ->toUPDATE(['deleted'],[$datetime])
            ->toWHERE('item_id','=',$id)
            ->toLIMIT(1)
            ->toEXECUTE();

            return [
                'check' => true,
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    }

    
    public function delete_order_comment($id){
        
        try{

            $datetime_ins = new DateTime();

            $datetime = $datetime_ins->format('Y-m-d H:i:s');

            $act = DB_function::create($this->order)
            ->connect('naisa')
            ->toUPDATE(['deleted'],[$datetime])
            ->toWHERE('item_id','=',$id)
            ->toLIMIT(1)
            ->toEXECUTE();

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
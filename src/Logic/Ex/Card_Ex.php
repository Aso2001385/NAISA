<?php 

require_once('DB_Function.php');

class Card_Ex
{

    private $main = 'card';

    public function add($data){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toINSERT($data)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'check' => $act['check']
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    public function get_new_single($user_id){
        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('user_id','=',$user_id)
            ->toDESC('id')
            ->toLIMIT(1)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'data'  => $act['data'],
                'check' => $act['check']
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

    public function get_multi($user_id){

        try{

            $act = DB_function::create($this->main)
            ->connect('naisa')
            ->toSELECT()
            ->toWHERE('user_id','=',$user_id)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return [
                'data'  => $act['data'],
                'check' => $act['check']
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }

}

?>
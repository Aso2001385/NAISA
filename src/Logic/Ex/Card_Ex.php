<?php 

require_once('DB_Function.php');

class Card_Ex
{

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

}

?>
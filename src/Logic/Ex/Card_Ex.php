<?php 

require_once('DB_Function.php');

class Card_Ex
{

    private $main = 'card';

    public function add($data){

        try{

            var_dump($data);

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

}

?>
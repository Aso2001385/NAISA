<?php

require_once('/home/users/2/versus.jp-aso2001385/web/NAISA/Logic/Ex/DB_Function.php');


/* 

user

id
name
mail
pass
tel
post
address
sale_count
penalty
created
updated
deleted

*/

class User_Ex
{

    private $main = 'user';

    public function get_authent($mail)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toSELECT()
            ->toWHERE('mail','=',$mail)
            ->toLIMIT(1)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;
            
        }catch(Exception $ex){

            return [
                'check' => false
            ];
    
        }

    }

    /* ユーザーデータ複数取得 */
    public function get_multi($limit = 25)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toSELECT()
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

    public function get_singul($id)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect()
            ->toSELECT()
            ->toWHERE('id','=',$id)
            ->toLIMIT(1)
            ->toEXECUTE(PDO::FETCH_ASSOC);

            return $act;

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }
    }


    public function add($data)
    {

        try{

            $act = DB_function::create($this->main)
            ->connect()
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


    public function update($data,$id=0)
    {

        try{

            if($id==0){

                $act = DB_function::create($this->main)
                ->connect()
                ->toUPDATE($data)
                ->toWHERE('id','=',$data['id'])
                ->toEXECUTE();


            }else{

                $act = DB_function::create($this->main)
                ->connect()
                ->toUPDATE($data)
                ->toWHERE('id','=',$id)
                ->toEXECUTE();

            }
    
            return [
                'check' => $act['check'],
            ];

        }catch(Exception $ex){

            return [
                'check' => false
            ];

        }

    } 

    public function delete($id)
    {

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
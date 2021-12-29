<?php

require_once 'DB_Function.php';

class Info_Ex
{

    private $main = 'info';

    public function add($user_id,$subject,$links,$contents)
    {

        $data = [
            'user_id' => $user_id,
            'subject' => $subject,
            'links' => $links,
            'contents' => $contents
        ];

        $act = DB_function::create($this->main)
        ->connect('naisa')
        ->toINSERT($data)
        ->toEXECUTE();

    }

    public function get_by_user_id($user_id)
    {
        $act = DB_function::create($this->main)
        ->connect('naisa')
        ->toSELECT(['id','subject'])
        ->toWHERE('user_id','=',$user_id)
        ->toDESC('id')
        ->toLIMIT(25)
        ->toEXECUTE(PDO::FETCH_ASSOC);

        return $act;

    }

    public function get_by_id($id){

        $act = DB_function::create($this->main)
        ->connect('naisa')
        ->toSELECT()
        ->toWHERE('id','=',$id)
        ->toDESC('id')
        ->toLIMIT(25)
        ->toEXECUTE(PDO::FETCH_ASSOC);

        return $act;


    }

}


?>
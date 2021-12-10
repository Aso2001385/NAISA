<?php

require_once 'Basic_Val.php';

class Special{

    public static function user_val($user_data)
    {

        $column = ['name','name_read','nick_name','mail','pass','tel','post'];

        foreach($column as $col){

            $method_name = $col.'_check';
            $act = Basic_Val::$method_name($user_data[$col]);
            
            if($act['check']){
                return [
                    'check' => false,
                    'message' => $col
                ];
            }

        }

        if($user_data['pass'] !== $user_data['re_pass']){
            return [
                'check' => false,
                'message' => 're_pass'
            ];
        }
        
        return true;

    }

    public static function edit_val($user_data)
    {

        $column = ['name','name_read','nick_name','mail','pass','tel','post'];

        foreach($column as $col){

            $method = $col.'_check';
            $act = Basic_Val::$method($user_data[$col]);
            
            if($act['check']){
                return [
                    'check' => false,
                    'message' => $col
                ];
            }

        }

        if($user_data['pass'] !== $user_data['re_pass']){
            return [
                'check' => false,
                'message' => 're_pass'
            ];
        }
        
        return true;

    }

    public static function login_val($login_data)
    {
        $column = ['mail','pass'];

        foreach($column as $col){

            $method = $col.'_check';
            $act = Basic_Val::$method($login_data[$col]);
            
            if($act['check']){
                return [
                    'check' => false,
                    'message' => $col
                ];
            }

        }

        if($user_data['pass'] !== $user_data['re_pass']){
            return [
                'check' => false,
                'message' => 're_pass'
            ];
        }
    
        return true;
    }
}

?>
<?php

require_once 'basic_Val.php';

class Special{

    public static function user_val($user_data)
    {

        $column = ['name','name_read','nick_name','mail','pass','tel','post'];

        foreach($column as $col){

            $act = $col.'_check'($user_data[$col]);
            if($act['check']){
                return false;
            }

        }

        if($user_data['pass'] !== $user_data['re_pass']){
            return false;
        }
        
        return true;

    }

    public static function edit_val($user_data)
    {

        $column = ['name','nick_name','mail','tel','post'];

        foreach($column as $col){

            $act = $col.'_check'($user_data[$col]);
            if($act['check']){
                return false;
            }

        }

        if($user_data['pass'] !== $user_data['re_pass']){
            return false;
        }
        
        return true;

    }

}

?>
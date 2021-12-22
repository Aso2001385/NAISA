<?php

require_once 'Basic_Val.php';

class Special{

    public static function user_val($user_data)
    {

        $column = ['name','name_read','nick_name','mail','pass','tel','post'];

        foreach($column as $col){

            $method_name = $col.'_check';

            $act = Basic_Val::$method_name($user_data[$col]);
            
            if(!$act['check']){
                
                return [
                    'check' => false,
                    'column' => $col,
                    'errors' => $act['errors']
                ];
            }

        }

        if($user_data['pass'] !== $user_data['re_pass']){
            return [
                'check' => false,
                'column' => 're_pass',
                'errors' => '入力内容が一致していません' 
            ];
        }
        
        return [
            'check' => $act['check']
        ];

    }

    public static function edit_val($user_data)
    {

        $column = ['name','name_read','nick_name','mail','tel','post'];

        foreach($column as $col){

            $method = $col.'_check';
            $act = Basic_Val::$method($user_data[$col]);
            
            if(!$act['check']){
                
                return [
                    'check' => false,
                    'column' => $col,
                    'errors' => $act['errors']
                ];
            }
        }

        return [
            'check' => true
        ];

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

    // public static function card_val($card_data){

    //     $limit = [[13,2,2,3],[14,2,2,4]];
    //     $i=0;
    //     foreach($card_data as $card){
    //         $act = Basic_Val::num_check($card,$limit[0][$i],$limit[1][$i++]);
    //         var_dump($act);
    //     }
    //     exit()

    // }
}

?>
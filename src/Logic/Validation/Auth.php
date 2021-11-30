<?php

require_once '..\Model\User_Model.php';

class Authent {
    /* データ登録 */
    public function auth_register ($data,$pass) 
    {

        $model_user = new User_Model();
        $pass = "732ec97fdce14b1895cecf0c8010ee".$regist['pass']."fa6e902564992ed34cf17b6a80520dd79f"; 
        $data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $model_user->add($data);

        if($act["check"]){
            return true;
        }else{
            return false;
        }
    
    }

    /* データ認証 */
    public function auth_authent ($authentData)
    {

        $model_user = new User_Model();
        $act = $model_user->get($authentData["mail"]);
        $pass = "solo".$authentData["pass"]."mon";

        if(password_verify($pass,$act["pass"])){

            return [ 
                "check" => true,
                "data" => $act
            ];

        }else{

            return [ 
                "check" => true,
                "message" => "認証に失敗しました"
            ];
            
        }

    }

    public function re_register() {

        $model_user = new User_Model();
        $act = $model_user->selectData($authentData["mail"]);
        $pass = "solo".$authentData["pass"]."mon";

        if(password_verify ($pass,$act["pass"])){
            return [ 
                "check" => true,
                "data" => $act
            ];
        }else{
            return [ 
                "check" => true,
                "message" => "認証に失敗しました"
            ];
        }
        
    }

    public function login_check(){

        if(!isset($_SESSION['user'])){
            header('Location:index.php?PICK=Login:login');
        }

    }
}
?>
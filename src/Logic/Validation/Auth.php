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
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$authentData["pass"].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';

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

    public function edit() {

        $model_user = new User_Model();
        $act = $model_user->selectData($authentData["mail"]);
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$authentData["pass"].'fa6e902564992ed34cf17b6a80520dd79f';

        if(password_verify ($pass,$act['data']['pass'])){
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
    
}
?>
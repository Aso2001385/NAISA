<?php

require_once 'C:\xampp\htdocs\school\Program_PHP2\music\Logic\Model\User.php';

class Authent {
    /* データ登録 */
    public function auth_regist ($registData,$passCoulmn) 
    {

        $model_user = new User_Master();
        $pass = "solo".$registData[$passCoulmn]."mon"; 
        $registData[$passCoulmn] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $model_user->insertData($registData);

        if($act["check"]){
            return true;
        }else{
            return false;
        }
    
    }

    /* データ認証 */
    public function auth_authent ($authentData)
    {

        $model_user = new User_Master();
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

    public function re_regist() {

        
    }

    public function login_check(){

        if(!isset($_SESSION['user'])){
            header('Location:index.php?PICK=Login:login');
        }

    }
}
?>
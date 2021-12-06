<?php

require_once '..\Ex\User_Ex.php';

class Authent {
    /* データ登録 */
    public static function auth_register ($data) 
    {

        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi'; 
        $data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->add($data);

        if($act["check"]){
            return true;
        }else{
            return false;
        }
    
    }

    /* データ認証 */
    public static function auth_authent ($authent_data)
    {

        $user_ex = new User_Ex();
        $act = $user_ex->get_authent($authent_data["mail"]);
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$authent_data["pass"].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';

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

    /* データ編集 */
    public static function auth_edit($edit_data) {


        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$edit_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';
        $data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->update($edit_data);

        if($act["check"]){
            return true;
        }else{
            return false;
        }

    }
    
}
?>
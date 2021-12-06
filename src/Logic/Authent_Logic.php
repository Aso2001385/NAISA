<?php


require_once 'Ex\User_Ex.php';
require_once 'Validation/Special_Val.php';
class Authent_Logic{

    public static function login_check()
    {
        $check = isset($_SESSION['user_data']);
        return $check;
    }


    /* ユーザー登録 */
    public static function user_register($user_data)
    {

        /* 入力チェック */
        $check = Special::user_val($user_data);

        if(!$check){
            // リダイレクト
        }

        /* 登録処理 */
        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi'; 
        $user_data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->add($data);

        return $act['check'];

    }

    /* ユーザー編集 */
    public static function user_edit($user_data)
    {

        $check = Special::user_val($user_data);

        if(!$check){
            // リダイレクト
        }
        
        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';
        $user_data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->update($user_data);

        return $act['check'];

    }

    /* ユーザー認証 */
    public static function user_login($user_data)
    {
        $user_ex = new User_Ex();
        $act = $user_ex->get_authent($user_data["mail"]);
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data["pass"].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';

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

    


}

?>
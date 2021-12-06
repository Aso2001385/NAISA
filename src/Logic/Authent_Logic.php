<?php
class Authent_Logic{

    public static function login_check()
    {
        $check = isset($_SESSION['user_data']);
        return $check;
    }

    public static function user_register($user_data)
    {

        require_once 'Validation/Auth.php';
        require_once 'Validation/Special_Val.php';

        $check = Special::user_val($user_data);

        if(!$check){
            // リダイレクト
        }

        $check = Authent::auth_register($user_data);

        return $check;

    }

    public static function user_authent($login_data)
    {
        require_once 'Validation/Auth.php';
        require_once 'Validation/Special_Val.php';

        $check = Special::user_val($user_data);

        if(!$check){
            // リダイレクト
        }

        $check = Authent::auth_edit($user_data);

        return $check;

    }

}

?>
<?php



class Authent_Logic{

    public static function login_check()
    {
        $check = isset($_SESSION['user_data']);
        return $check;
    }

    public static function user_register($user_data)
    {
        require_once 'Ex/User_Ex.php';
        require_once 'Validation/Auth.php';
        require_once 'Validation/Special_Val.php';


    }



}

?>
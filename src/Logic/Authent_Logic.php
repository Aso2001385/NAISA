<?php

require_once 'Validation/basicValidation.php';

class Authent_Logic{

    public static function login_check()
    {

        $check = isset($_SESSION['user_data']);
        
    }



}

?>
<?php 

    require('C:/xampp/htdocs/school/Program_PHP2/music/Model/Valodation.php');

    function nameCheck($receive,$low,$upper){
    
        $checkData = Validation::creat()->input($receive)
        ->charType(1,1,0,0,1,1,1)
        ->toSYMBOL()
        ->toLENGTH($low,$upper)
        ->toEXECUTE();

        return $checkData;

    }
    
    function passwordCheck($receive,$low,$upper){
        
        $checkData = Validation::creat()->input($receive)
        ->charType(1,1,1,1,0,0,0)
        ->toSYMBOL("-_")
        ->toLENGTH($low,$upper)
        ->toEXECUTE();

        return $checkData;

    }

    function mailCheck($receive,$low,$upper){
        
        $checkData = Validation::creat()->input($receive)
        ->toLENGTH($low,$upper)
        ->toMAIL();

        return $checkData;

    }

    function telCheck($receive){

        $checkData = Validation::creat()->input($receive)
        ->charType(0,0,1,0,0,0,0)
        ->toSYMBOL()
        ->toLENGTH(10,11)
        ->toEXECUTE();

        return $checkData;
    }

    function postCheck($receive){

        $checkData = Validation::creat()->input($receive)
        ->charType(0,0,1,0,0,0,0)
        ->toSYMBOL()
        ->toLENGTH(7,7)
        ->toEXECUTE();

        return $checkData;
    }

?>
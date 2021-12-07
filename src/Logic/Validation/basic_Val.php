<?php 

    require('Validation.php');

    function name_check($receive,$low=2,$upper=50){
    
        $checkData = Validation::creat()->input($receive)
        ->charType(1,1,0,0,1,1,1)
        ->toSYMBOL('-_')
        ->toLENGTH($low,$upper)
        ->toEXECUTE();

        return $checkData;

    }

    function name_read_check($receive,$low=2,$upper=150){
    
        $checkData = Validation::creat()->input($receive)
        ->charType(0,0,0,0,0,0,1)
        ->toSYMBOL('-_')
        ->toLENGTH($low,$upper)
        ->toEXECUTE();

        return $checkData;

    }

    function nick_name_check($receive,$low=1,$upper=50){
    
        $checkData = Validation::creat()->input($receive)
        ->charType(1,1,1,1,1,1,1)
        ->toSYMBOL('-_')
        ->toLENGTH($low,$upper)
        ->toEXECUTE();

        return $checkData;

    }
    
    function password_check($receive,$low=8,$upper=40){
        
        $checkData = Validation::creat()->input($receive)
        ->charType(1,1,1,1,0,0,0)
        ->toSYMBOL('-_')
        ->toLENGTH($low,$upper)
        ->toEXECUTE();
        
        if(!$checkData['check']){
            return $checkData;
        }

        $word = ['a-z','A-Z','0-9','-_'];

        $ans = $receive;

        foreach($word as $row){

            $ans = preg_replace("/[{$row}]/u",'',$receive); 
            if(mb_strlen($ans) == mb_strlen($receive)){
                return [
                    'check' => false,
                    'errors' => '入力必須文字が入力されていません'
                ];
            }
            $receive = $ans;
        }
        
        return $checkData;

    }

    function mail_check($receive,$low=8,$upper=50){
        
        $checkData = Validation::creat()->input($receive)
        ->toLENGTH($low,$upper)
        ->toMAIL();

        return $checkData;

    }

    function tel_check($receive){

        $checkData = Validation::creat()->input($receive)
        ->charType(0,0,1,0,0,0,0)
        ->toSYMBOL()
        ->toLENGTH(10,11)
        ->toEXECUTE();

        if(substr($receive,0,1) != 0){
            return [
                'check' => false,
                'errors' => '一桁目が0以外の数字です'
            ];
        }

        return $checkData;
    }

    function post_check($receive){

        $checkData = Validation::creat()->input($receive)
        ->charType(0,0,1,0,0,0,0)
        ->toSYMBOL()
        ->toLENGTH(7,7)
        ->toEXECUTE();

        return $checkData;
    }

?>
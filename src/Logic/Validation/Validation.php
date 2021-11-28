<?php

class Validation {

    private $receive;
    private $check = true;
    private $charTypes = [];
    private $symbol;
    private $errors = [];

    public static function creat (){
        return new Validation();
    }


    /* チェック対象の文字列を設定 */
    // $receive チェック対象

    public function input($receive)
    {

        $this->receive = $receive;

        return $this;
        
    }

    /* 入力を許可する文字種を設定*/

    // 入力不可  0
    // 入力許可  1
    // $uppercase 大文字
    // $lowcase 小文字
    // $number 数字
    // $symbol 記号
    // $kanji
    // $hiragana
    // $katakana

    public function charType($uppercase,$lowcase,$number,$symbol,$kanji,$hiragana,$katakana)
    {
        $this->charTypes = [
            'uppercase' => $uppercase,
            'lowcase'   => $lowcase,
            'number'    => $number,
            'symbol'    => $symbol,
            'kanji'     => $kanji,
            'hiragana'  => $hiragana,
            'katakana'  => $katakana
        ];

        return $this;
        
    }

    /* 入力桁数・文字数チェック */
    // $low  桁数下限
    // $uper 桁数上限(省略化)
    public function toLENGTH($low,$uper = 20000)
    {

        $str_count = mb_strlen($this->receive);
        
        if($str_count == false){
            throw new Exception("文字数チェック：入力値エラー");
        }

        if($str_count < $low){
            $this->check = false;
            $this->errors["toLENGTH"] = ["low" => "下限値を下回っています"];  
        }

        if($str_count > $uper){
            $this->check = false;
            $this->errors["toLENGTH"] = ["uper" => "上限値を上回っています"];
        }

        return $this;
        
    }


    /* 入力を許可する記号を設定する*/
    // $symbol 記号(指定しなければ全部許可される)

    public function toSYMBOL($symbol = '!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-')
    {

        $this->symbol =  $symbol;
        return $this;
        
    }

    public function toMAIL(){
        if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|',$this->receive)) {
            $this->check = false;
            $this->errors["toMAIL"] = ["case" => "メールアドレスのフォーマットではありません"];
        }
        return ['check'=>$this->check, 'errors'=>$this->errors];
    }

    /* 文字種チェック */
    public function toEXECUTE()
    {
     
        $case = ['A-Z','a-z','0-9',$this->symbol,'一-龠','ぁ-んー','ァ-ヶー'];
        $permission = "";
        $i=0;
        foreach($this->charTypes as $row){
            if($row == 1){
                $permission .= $case[$i];
                if($row == 4 || $row == 5 || $row == 6){
                    mb_regex_encoding("UTF-8");
                }
            }

            $i++;
        }

        $permission = "/^[{$permission}]+$/u";
        
        if(!preg_match($permission,$this->receive)) {
            $this->check = false;
            $this->errors["toEXECUTE"] = ["case" => "許可されていません"];
        }

        return ['check'=>$this->check, 'errors'=>$this->errors];

    }

}

?>
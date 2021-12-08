<?php

require_once 'Validation/Special_Val.php';
require_once 'Ex/User_Ex.php';
require_once 'Ex/Card_Ex.php';

/*

= user
+ id(自動入力)
- name
- name_read
- nick_name
- mail
- pass
- tel
- post
- address
^ sale_count
^ penalty
^ created
^ updated
^ deleted

*/

class Authent_Logic{

    public static function login_check()
    {
        return isset($_SESSION['user']);
    }

    public static function input_retention($user_data){

        if(!Special::user_val($user_data)){
            return false;
        }

        $_SESSION['register'] = $user_data;

    }


    /* ユーザー登録 */
    public static function user_register($user_data)
    {

        /* 入力チェック */
        if(!Special::user_val($user_data)){
            return false;
        }

        /* 登録処理 */
        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi'; 
        $user_data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->add($data);

        return $act['check'];

    }

    /* カード登録 */
    public static function card_rigister($card_data,$mail){

        if(!Special::card_val($card_data)){
            return false;
        }

        $user_ex = new User_Ex();
        $card_ex = new Card_Ex();

        $act = $user_ex->get_authent($mail);

        if(!$act['check']){
            return false;
        }

        $card_data =  array_merge($card_data,array('user_id'=>$act['data']['id']));

        $act = $card_ex->add($card_data);

        return $act['check'];

    }

    /* ユーザー編集 */
    public static function user_edit($user_data)
    {
        /* 入力チェック */
        $check = Special::user_val($user_data);

        if(!$check){
            // リダイレクト
        }
        
        /* 更新 */
        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';
        $user_data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->update($user_data);

        return $act['check'];

    }

    /* パスワード編集 */
    public static function pass_edit($user_data)
    {
        /* 入力チェック */
        $check = Special::user_val($user_data);

        if(!$check){
            // リダイレクト
        }
        
        /* 更新 */
        $user_ex = new User_Ex();
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';
        $user_data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->update($user_data);

        return $act['check'];

    }

    /* ユーザー削除 */
    public static function user_delete()
    {

        $user_ex = new User_Ex();
        $act = $user_ex->delete($_SESSION['user_data']['id']);

        return $act['check'];

    }

    /* ユーザー認証 */
    public static function user_login($user_data)
    {
        /* メールアドレスでデータ取得 */
        $user_ex = new User_Ex();
        $act = $user_ex->get_authent($user_data["mail"]);
        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data["pass"].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi';

        /* パスワード照合 */
        if(password_verify($pass,$act["pass"])){

            /* セッションにデータ挿入 */
            $_SESSION['user_data'] = $act['data'];

            return [ 
                "check" => true,
            ];

        }else{

            return [ 
                "check" => true,
                "message" => "認証に失敗しました"
            ];
            
        }

    }

    /* ユーザーログアウト */
    public static function user_logout($user_data)
    {

        return session_destroy();

    }
    


}

?>
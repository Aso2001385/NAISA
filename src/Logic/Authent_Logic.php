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

    public static function header_set(){

        $output = '';

        if(isset($_SESSION['user'])){

            $output .= "<a href='info.php'><li>お知らせ</li></a>";
            $output .= "<a href='my_menu.php'><li>{$_SESSION['user']['nick_name']}<br>マイページ</li></a>";
            $output .= "<a href='logout.php'><li>ログアウト</li></a>";
            
        }else{

            $output .= "<a href='info.php'><li>お知らせ</li></a>";
            $output .= "<a href='login.php'><li>ログイン</li></a>";
            $output .= "<a href='user_register.php'><li>新規登録</li></a>";
        
        }

        return $output;

    }

    public static function input_retention($user_data){

        $user_ex = new User_Ex();
        if(isset($_SESSION['tmp_user'])) unset($_SESSION['tmp_user']);
        $_SESSION['tmp_user'] = $user_data;

        $val_check = Special::user_val($user_data);       
        $act = $user_ex->get_authent($user_data['mail']);

        if($act['check']){
            $val_check['column'] = 'mail';
            $val_check['errors'] = 'このメールアドレスは既に登録されています';
        }
        
        return $val_check;

    }


    /* ユーザー登録 */
    public static function user_register($user_data)
    {

        /* 入力チェック */
        $val_check = Special::user_val($user_data);
   
        if(!$val_check['check']){
            return [
                'chack' => false,
                'column' => $val_check['column'] ,
                'errors' => $val_check['errors'] ,
                'error_type' => '0' ,
            ];
        }

        /* 登録処理 */
        $user_ex = new User_Ex();

        /* 既にメールアドレスが登録されているか */
        $act = $user_ex->get_authent($user_data['mail']);

        if($act['check'] && $act['data']){
            return [
                'chack' => false,
                'column' => 'mail' ,
                'errors' => 'このメールアドレスは既に登録されています',
                'error_type' => 0
            ];
        }

        unset($user_data['re_pass']);

        $pass = '$2y$10$Fx4FReusbCKrVvWVEkWjEuc'.$user_data['pass'].'dhIdcqrozCZMLKdZPw2fMKv4cw9pJi'; 
        $user_data['pass'] = password_hash($pass,PASSWORD_BCRYPT);
        $act = $user_ex->add($user_data);

        if(!$act['check']){
            return [
                'chack' => false,
                'error_type' => 1 //登録失敗
            ];
        }else{
            return [
                'chack' => true
            ];
        }

    }

    /* カード登録 */
    public static function card_rigister($card_data,$mail){

        if(!Special::card_val($card_data)) return false;

        $user_ex = new User_Ex();
        $card_ex = new Card_Ex();

        $act = $user_ex->get_authent($mail);

        if(!$act['check']) return false;

        $card_data = array_merge($card_data,array('user_id'=>$act['data']['id']));

        $act = $card_ex->add($card_data);

        return $act['check'];

    }

    /* ユーザー編集 */
    public static function user_edit($user_data,$id)
    {
        /* 入力チェック */
        $check = Special::edit_val($user_data);
        
        if(!$check){
            // リダイレクト
        }
        
        /* 更新 */
        $user_ex = new User_Ex();

        $act = $user_ex->update($user_data,$id);

        if($act['check']){
            $act = $user_ex->get_singul($id);
            /* セッションにデータ挿入 */
            unset($_SESSION['user']);
            $_SESSION['user'] = $act['data'];
            $_SESSION['user']['id'] = $id;
        }

        return $act;

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
        if(password_verify($pass,$act["data"]["pass"])){

            /* セッションにデータ挿入 */
            $_SESSION['user'] = $act['data'];

            return [ 
                "check" => true,
            ];

        }else{

            return [ 
                "check" => false,
                "message" => "認証に失敗しました"
            ];
            
        }

    }

    public static function get_user($user_id)
    {
        $user_ex = new User_Ex();
        $act = $user_ex->get_singul($user_id);

        return $act;

    }

    /* ユーザーログアウト */
    public static function user_logout($user_data)
    {

        return session_destroy();

    }
    


}

?>
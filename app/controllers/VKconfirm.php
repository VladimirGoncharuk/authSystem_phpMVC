<?php
namespace App\controllers;
require_once 'app/models/users.php';

session_start ();

class VKconfirm extends \App\core\Controller
{

    public function index(){  
        if  (!empty($_GET ['code']))  {
            $id_app     =     '51691065' ;                      //Айди приложения
            $secret_app =    '76Sk3oNq4ylWNEM80BFD';         // Защищённый ключ. Можно узнать там же где и айди
            $url_script   =    "http://localhost:8000/VKconfirm/index/"; //ссылка на этот скрипт
			$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.$id_app.'&client_secret='.$secret_app.'&code='.$_GET['code'].'&redirect_uri='.$url_script.'&v=5.126'), true);
            $fields = 'first_name';
            $uinf = json_decode(file_get_contents('https://api.vk.com/method/users.get?uids='.$token['user_id'].'&fields='.$fields.'&access_token='.$token['access_token'].'&v=5.126'), true); 
            $_SESSION['name']         = $uinf['response'][0]['first_name'];
            $_SESSION['uid']          = $token['user_id'];
            $_SESSION['access_token'] = $token['access_token'];
            $_SESSION['email']  =isset($token['email'])?$token['email']:''; //если пользователь разрешил доступ к email
            $user = new \App\models\UserVK;
            $_SESSION['user'] = $user->role;
            if(!empty($_SESSION['email'])&&!\App\data\DB::isEmailAlreadyExists($_SESSION['email'])){
          
            \App\data\DB::register($user);           
           }            
           
           header("Location: /galleryadd");
               }      

    }
  
}


?>

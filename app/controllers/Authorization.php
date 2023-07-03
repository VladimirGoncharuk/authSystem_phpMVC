<?php
namespace App\controllers;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

session_start();

class Authorization extends \App\core\Controller
{
public function index(){
    
      $log = new Logger('mylogger');
      $log->pushHandler(new StreamHandler(dirname(__DIR__, 1) . '/core/config/log', Logger::WARNING));   
     if(!empty($_POST)&&($_POST["token"] == $_SESSION["CSRF"])){   
         $this->authorization($_POST);
     }
     else{  
          $log->warning('Отказано в доступе! Пройдите регистрацию!');
          $errors[]['name'] = 'Отказано в доступе! Пройдите регистрацию!';  
          http_response_code(401);
          echo json_encode([
            'errors' => $errors 
        ]);   
     }
}

public function authorization(array $request){
     $log = new Logger('mylogger');
     $log->pushHandler(new StreamHandler(dirname(__DIR__, 1) . '/core/config/log', Logger::WARNING)); 
    if(!empty($request)){    
        $errors = $this->validate($request);    
        if(empty($errors)){
           $check = \App\data\DB::check($request);
           if(!$check){
          $log->warning('Указанного пользователя не существует'); 
          $errors[]['name'] = 'Указанного пользователя не существует';
            http_response_code(401);
            echo json_encode([
              'errors' => $errors
            ]); 
           }else{
           $hash = $check['password'];
            if($hash){
                $password =$request['password'];
                $verify = password_verify($password,$hash);
                if(!$verify){  
                $errors[]['name'] = 'Пароль введен не верно';
                $log->warning('Пароль введен не верно');  
                http_response_code(401);
                echo json_encode([
                'errors' => $errors
               ]);    
                }else{
                    
                    $_SESSION['user'] = $check['role'];
                    $_SESSION['nameUser'] = $request['name'];
               }
            }  
        }
        }else {
        http_response_code(401);
        echo json_encode([
          'errors' => $errors 
      ]);} ;
    }
    }

     
public function validate(array $request){
    $errors = [];
    if (!isset($request['email']) || strlen($request['email']) == 0) {
         $errors[]['email'] = 'Email не указан';
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
         $errors[]['email'] = 'Неправильный формат email';
    } elseif (strlen($request['email']) < 4) {
         $errors[]['email'] = 'Email должен быть больше 4х символов';
    }    
    if (!isset($request['name']) || empty($request['name'])) {
         $errors[]['name'] = 'Имя не указано';
    } 
    if (!isset($request['password']) || empty($request['password'])) {
         $errors[]['password'] = 'Пароль не указан.Можете войти через ВК';
    }
    if (!isset($request['repeat-password']) || empty($request['repeat-password'])) {
         $errors[]['repeat-password'] = 'Нужно повторить пароль';
    } elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {
         $errors[]['repeat-password'] = 'Пароли не совпадают';
    }
    return $errors ;
}

}
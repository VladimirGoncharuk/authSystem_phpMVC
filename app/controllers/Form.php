<?php
namespace App\controllers;
require_once 'app/models/users.php';

session_start();

class Form extends \App\core\Controller
{

public function index(){
    
     if(!empty($_POST)){   
     $this->registration($_POST);
     }
}

public function registration(array $request){
    if(!empty($request)){    
        $errors = $this->validate($request);    
        if(empty($errors)){  
         $user = new \App\models\User($_POST);
         $_SESSION['user'] = $user->role;
         \App\data\DB::register($user);  
        $_SESSION['nameUser'] = $request['name'];
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
    } elseif (\App\data\DB::isEmailAlreadyExists($request['email'])) {
        
        $errors[]['email'] = 'Email уже используется';
            }
    if (!isset($request['name']) || empty($request['name'])) {
         $errors[]['name'] = 'Имя не указано';
    } elseif (\App\data\DB::isNameAlreadyExists($request['name'])) {
        $errors[]['name'] = 'Имя уже используется';
            }
     if (!isset($request['password']) || empty($request['password'])) {
        $errors[]['password'] = 'Пароль не указан';
            }
    if (!isset($request['repeat-password']) || empty($request['repeat-password'])) {
        $errors[]['repeat-password'] = 'Нужно повторить пароль'; 
    }elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {
        $errors[]['repeat-password'] = 'Пароли не совпадают';
            }
    return $errors ;
    }

}

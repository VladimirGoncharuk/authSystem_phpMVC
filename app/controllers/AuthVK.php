<?php
namespace App\controllers;

session_start();
class AuthVK extends \App\core\Controller
{
public function index(){
  
    if(!(!empty($_POST)&&($_POST["token"] == $_SESSION["CSRF"]))){   
    
     $errors[]['name'] = 'Отказано в доступе! Пройдите регистрацию!';  
     http_response_code(401);
     echo json_encode([
       'errors' => $errors 
   ]);   
}
}
}
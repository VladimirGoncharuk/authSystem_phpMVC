<?php
namespace App\data;
use RedBeanPHP\R;

session_start();
class DB extends \App\core\Controller
{
    public static function register(object $data){

        $user= R::dispense('users');
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password =$data->password;
        $user->created = (new \DateTime())->format('Y-m-d H:i:s');
        $user->role = $data->role;
        
        R::store($user);
        }
    public static function isEmailAlreadyExists(string $email){
        $result =R::find(  'users' , 'email = :email' , [':email' => $email] );
        
        if ($result) {
             return true;
        }
        return false;
    }
    public static function isNameAlreadyExists(string $name){
        $result =R::find( 'users' ,'name = :name', [':name' => $name] );
        
           if ($result) {
             return true;
        }
        return false;
    }
    public static function check(array $data){
        $result =R::findOne( 'users' , 'name = :name', [':name' => $data['name']] );
        
         return $result;
    }   
    
}


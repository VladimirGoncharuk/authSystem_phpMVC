<?php
namespace App\models;

session_start();
class UserVK  {
    public string $name;
    public string $email;
    public string $role;
    
public function __construct( )
{
    $this->name = $_SESSION['name'];
    $this->email = $_SESSION['email'];
    $this->role = 'userVK'; 
    
}   
} 
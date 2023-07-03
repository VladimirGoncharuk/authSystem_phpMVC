<?php
namespace App\models;

session_start();

class User  {
    public string $name;
    public string $email;
    public string $password;
    public string $role;

public function __construct(array $entity = null )
{
    $this->name = $entity['name'];
    $this->email = $entity['email'];
    $this->password = password_hash($entity['password'], PASSWORD_ARGON2ID);
    $this->role = 'user';    
}   
} 


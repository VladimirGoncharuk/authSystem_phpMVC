<?php
namespace App\controllers;

session_start();
class Home extends \App\core\Controller
{

    public function index(){          
        $this->view->render('home.php','template.phtml');
    }
    public function out(){    
     session_destroy();
    }
}


<?php
namespace App\controllers;

session_start();
class Galleryadd extends \App\core\Controller
{

    public function index(){    
        $this->view->render('gallery.php','template.phtml');
    
    }
   
}


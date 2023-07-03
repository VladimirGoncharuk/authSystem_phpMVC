<?php

namespace App;
use RedBeanPHP\R;
use RedBeanPHP\RedException;
session_start();

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';



try{
    R::setup('sqlite:'. DATA . 'db.sqlite');
    if(!R::testConnection()){
        throw new RedException('No connect');
    }
}
catch(RedException $e) {
    exit(var_dump($e));
}


core\Route::start();

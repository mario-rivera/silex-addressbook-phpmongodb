<?php
namespace App\Controllers\Home;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController{

    public function get( Application $app, Request $request ){
        return 'Hello World';
    }
}

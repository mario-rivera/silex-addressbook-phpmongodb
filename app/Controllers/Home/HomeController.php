<?php
namespace App\Controllers\Home;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;

class HomeController{

    public function __construct(Twig_Environment $twig){

        $this->twig = $twig;
    }

    public function get( Application $app, Request $request ){

        return $this->twig->render('home/helloworld.html', []);
    }
}

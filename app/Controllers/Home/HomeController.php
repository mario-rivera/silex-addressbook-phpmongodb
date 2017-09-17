<?php
namespace App\Controllers\Home;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;
use App\DataLayer\Models\Organization;

class HomeController{

    public function __construct(Twig_Environment $twig){

        $this->twig = $twig;
    }

    public function get( Application $app, Request $request ){

        return $this->twig->render('home/organizations.html', [
            'orgs'  => Organization::all()
        ]);
    }
}

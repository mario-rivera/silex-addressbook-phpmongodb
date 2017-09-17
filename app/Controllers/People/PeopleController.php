<?php
namespace App\Controllers\People;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Twig_Environment;
use DI\Container as DIContainer;

use App\DataLayer\Models\Organization;
use App\DataLayer\Models\Person;

use Exception;

class PeopleController{

    public function __construct(Twig_Environment $twig, DIContainer $di){

        $this->twig = $twig;
        $this->di = $di;
    }

    public function new( Application $app, Request $request, $org_id ){

        return $this->twig->render('people/edit.html', [
        ]);
    }
}

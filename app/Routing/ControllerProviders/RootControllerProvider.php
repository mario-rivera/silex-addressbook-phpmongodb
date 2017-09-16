<?php
namespace App\Routing\ControllerProviders;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class RootControllerProvider implements ControllerProviderInterface{

    public function connect(Application $app){

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];


        $controllers->get('/', 'App\Controllers\Home\HomeController::get');
        return $controllers;
    }
}

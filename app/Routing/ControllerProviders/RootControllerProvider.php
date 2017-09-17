<?php
namespace App\Routing\ControllerProviders;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class RootControllerProvider implements ControllerProviderInterface{

    public function connect(Application $app){

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', [\App\Controllers\Home\HomeController::class, 'get']);

        $controllers->get('/organization/new', [\App\Controllers\Organizations\OrganizationController::class, 'new']);
        $controllers->post('/organization/new', [\App\Controllers\Organizations\OrganizationController::class, 'postNew']);
        $controllers->get('/organization/edit/{id}', [\App\Controllers\Organizations\OrganizationController::class, 'edit']);
        $controllers->post('/organization/edit/{id}', [\App\Controllers\Organizations\OrganizationController::class, 'postEdit']);
        
        $controllers->get('/organization/{id}', [\App\Controllers\Organizations\OrganizationController::class, 'view']);

        return $controllers;
    }
}

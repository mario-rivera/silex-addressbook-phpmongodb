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
        $controllers->get('/organization/delete/{id}', [\App\Controllers\Organizations\OrganizationController::class, 'delete']);

        $controllers->get('/organization/{id}', [\App\Controllers\Organizations\OrganizationController::class, 'view']);

        $controllers->get('/organization/{org_id}/people/new', [\App\Controllers\People\PeopleController::class, 'new']);
        $controllers->post('/organization/{org_id}/people/new', [\App\Controllers\People\PeopleController::class, 'postNew']);
        $controllers->get('/organization/{org_id}/people/{person_id}', [\App\Controllers\People\PeopleController::class, 'view']);

        $controllers->get('/organization/{org_id}/people/edit/{person_id}', [\App\Controllers\People\PeopleController::class, 'edit']);
        $controllers->post('/organization/{org_id}/people/edit/{person_id}', [\App\Controllers\People\PeopleController::class, 'postEdit']);
        $controllers->get('/organization/{org_id}/people/delete/{person_id}', [\App\Controllers\People\PeopleController::class, 'delete']);

        return $controllers;
    }
}

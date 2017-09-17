<?php
namespace App\Controllers\Organizations;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Twig_Environment;
use DI\Container as DIContainer;

use App\DataLayer\Models\Organization;
use App\Organizations\EditOrganization;

use Exception;

class OrganizationController{

    public function __construct(Twig_Environment $twig, DIContainer $di){

        $this->twig = $twig;
        $this->di = $di;
    }

    public function view( Application $app, Request $request, $id ){

        $organization = Organization::id( $id );
        if( !$organization ){

            throw new Exception( 'Organization not found.' );
        }

        return $this->twig->render('organizations/view.html', [
            'org'   => $organization
        ]);
    }

    public function new( Application $app, Request $request ){

        return $this->twig->render('organizations/edit.html', [
        ]);
    }

    public function postNew( Application $app, Request $request ){

        try{

            $editService = $this->di->make(EditOrganization::class);
            $organization = $editService->saveOrganization( new Organization(), $_POST );
        } catch( \Respect\Validation\Exceptions\ExceptionInterface $e ){

            return $this->twig->render('organizations/edit.html', [
                'error_message' => $e->getFullMessage(),
                'validation_messages' => $e->getMessages(),
                'data' => (object) $_POST
            ]);
        }

        $id = ( is_object($organization->getId()) ) ? $organization->getId()->__toString() : $organization->getId();
        return $app->redirect( "/organization/{$id}" );
    }

    public function edit( Application $app, Request $request, $id ){

        $organization = Organization::id( $id );
        if( !$organization ){

            throw new Exception( 'Organization not found.' );
        }

        return $this->twig->render('organizations/edit.html', [
            'data'  => $organization
        ]);
    }

    public function postEdit( Application $app, Request $request, $id ){

        $organization = Organization::id( $id );
        if( !$organization ){

            throw new Exception( 'Organization not found.' );
        }

        try{

            $editService = $this->di->make(EditOrganization::class);
            $organization = $editService->saveOrganization( $organization, $_POST );
        } catch( \Respect\Validation\Exceptions\ExceptionInterface $e ){

            return $this->twig->render('organizations/edit.html', [
                'error_message' => $e->getFullMessage(),
                'validation_messages' => $e->getMessages(),
                'data' => $organization
            ]);
        }

        $id = ( is_object($organization->getId()) ) ? $organization->getId()->__toString() : $organization->getId();
        return $app->redirect( "/organization/{$id}" );
    }
}

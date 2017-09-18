<?php
namespace App\Controllers\People;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Twig_Environment;
use DI\Container as DIContainer;

use App\DataLayer\Models\Organization;
use App\DataLayer\Models\Person;

use App\People\EditPerson;

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

    public function postNew( Application $app, Request $request, $org_id ){

        $organization = Organization::id( $org_id );
        if( !$organization ){

            throw new Exception( 'Failed to save contact. Organization not found.' );
        }

        try{

            $editService = $this->di->make(EditPerson::class);
            $person = $editService->saveNewPerson( new Person(), $_POST, $organization );
        } catch( \Respect\Validation\Exceptions\ExceptionInterface $e ){

            return $this->twig->render('people/edit.html', [
                'error_message' => $e->getFullMessage(),
                'validation_messages' => $e->getMessages(),
                'data' => (object) $_POST
            ]);
        }

        $id = ( is_object($person->getId()) ) ? $person->getId()->__toString() : $person->getId();
        return $app->redirect( "/organization/{$org_id}/people/{$id}" );
    }

    public function view( Application $app, Request $request, $org_id, $person_id ){

        $person = Person::id( $person_id );
        if( !$person ){

            throw new Exception( 'Contact not found.' );
        }

        return $this->twig->render('people/view.html', [
            'person' => $person,
            'org_id' => $org_id
        ]);
    }

    public function edit( Application $app, Request $request, $org_id, $person_id ){

        $person = Person::id( $person_id );
        if( !$person ){

            throw new Exception( 'Contact not found.' );
        }

        return $this->twig->render('people/edit.html', [
            'data'  => $person
        ]);
    }

    public function postEdit( Application $app, Request $request, $org_id, $person_id ){

        $person = Person::id( $person_id );
        if( !$person ){

            throw new Exception( 'Contact not found.' );
        }

        try{

            $editService = $this->di->make(EditPerson::class);
            $person = $editService->savePerson( $person, $_POST );
        } catch( \Respect\Validation\Exceptions\ExceptionInterface $e ){

            return $this->twig->render('people/edit.html', [
                'error_message' => $e->getFullMessage(),
                'validation_messages' => $e->getMessages(),
                'data' => $person
            ]);
        }

        $id = ( is_object($person->getId()) ) ? $person->getId()->__toString() : $person->getId();
        return $app->redirect( "/organization/{$org_id}/people/{$id}" );
    }
}

<?php
namespace App\People;

use App\DataLayer\Models\Person;
use App\Services\Validation\PersonValidator;
use App\DataLayer\Models\Organization;

class EditPerson{

    public function __construct( PersonValidator $personValidator ){

        $this->personValidator = $personValidator;
    }

    public function saveNewPerson(Person $person, $data, Organization $org){

        $person = $this->savePerson( $person, $data );
        // associate the contact with the organization
        $org->people->add($person);
        $org->save();

        return $person;
    }

    public function savePerson( Person $person, $data ){

        $this->personValidator->validate( $data );

        // http://php.net/manual/en/function.array-intersect-key.php#109706
        $allowedData = array_intersect_key( $data, array_flip($person::$massAssign) );

        foreach( $allowedData as $property => $value ){

            $person->$property = $value;
        }

        $person->save();
        return $person;
    }

    public function delete(Person $person){

        return $person->delete();
    }
}

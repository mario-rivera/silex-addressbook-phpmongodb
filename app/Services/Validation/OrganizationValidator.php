<?php
namespace App\Services\Validation;

use Respect\Validation\Validator;

class OrganizationValidator{

    public function __construct(){

    }

    public function validate($data){

        Validator::key('name')->key('postcode')->key('address')->assert($data);

        Validator::stringType()->notEmpty()->setName("Name")->assert( $data['name'] );
        Validator::stringType()->length(1, 10)->setName('Postcode')->assert( $data['postcode'] );
        Validator::stringType()->notEmpty()->setName('Address')->assert( $data['address'] );
    }
}

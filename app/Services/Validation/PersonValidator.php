<?php
namespace App\Services\Validation;

use Respect\Validation\Validator;

class PersonValidator{

    public function __construct(){

    }

    public function validate($data){

        Validator::key('name')->key('phone')->key('job_title')->assert($data);

        Validator::stringType()->notEmpty()->setName("Name")->assert( $data['name'] );
        Validator::Phone()->setName('Phone')->assert( $data['phone'] );
        Validator::stringType()->notEmpty()->setName('Job Title')->assert( $data['job_title'] );
    }
}

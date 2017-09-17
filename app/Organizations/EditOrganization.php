<?php
namespace App\Organizations;

use App\DataLayer\Models\Organization;
use App\Services\Validation\OrganizationValidator;

class EditOrganization{

    public function __construct( OrganizationValidator $orgValidator ){

        $this->orgValidator = $orgValidator;
    }

    public function saveOrganization( Organization $org, $data ){

        $this->orgValidator->validate( $data );

        // http://php.net/manual/en/function.array-intersect-key.php#109706
        $allowedData = array_intersect_key( $data, array_flip($org::$massAssign) );

        foreach( $allowedData as $property => $value ){

            $org->$property = $value;
        }

        $org->save();
        return $org;
    }
}

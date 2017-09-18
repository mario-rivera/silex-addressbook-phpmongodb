<?php
namespace App\DataLayer\Models;

use Purekid\Mongodm\Model;

class Person extends Model{

    static $collection = "people";

    protected static $attrs = array(
        // 1 to 1 reference
        // 'org' => array('model'=>'App\DataLayer\Models\Organization','type'=> Model::DATA_TYPE_REFERENCE)
    );

    public static $massAssign = ['name', 'phone', 'job_title'];
}

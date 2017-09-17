<?php
namespace App\DataLayer\Models;

use Purekid\Mongodm\Model;

class Organization extends Model{

    static $collection = "organizations";

    protected static $attrs = array(
         // 1 to many references
        'people' => array('model'=>'App\DataLayer\Models\Person','type'=> Model::DATA_TYPE_REFERENCES)
    );

    public static $massAssign = ['name', 'postcode', 'address'];
}

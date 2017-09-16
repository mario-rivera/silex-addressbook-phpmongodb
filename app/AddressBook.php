<?php
namespace App;

use Silex\Application;

class AddressBook extends Application{

    public function load(){

        $this['debug'] = true;

        $this->get('/', function () {
            return 'Hello World';
        });

        return $this;
    }
}

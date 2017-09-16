<?php
namespace App;

use DI\Bridge\Silex\Application;

class AddressBook extends Application{

    public function load(){

        $this['debug'] = true;
        $this['dir.app'] = __DIR__;

        $this->bootServiceProviders();

        return $this;
    }

    private function bootServiceProviders(){

        $providers =  require_once  __DIR__ . '/Services/definitions.php';

        foreach( $providers as $provider ){
            $this->register(new $provider);
        }
    }
}

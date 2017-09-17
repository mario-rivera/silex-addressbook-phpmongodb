<?php
namespace App\Services\MongoDM;

use Pimple\ServiceProviderInterface;
use Pimple\Container;

use Purekid\Mongodm\ConnectionManager;

class MongodmServiceProvider implements ServiceProviderInterface{

    public function register(Container $app){

        ConnectionManager::setConfigBlock('default', array(
            'connection' => array(
                'hostnames' => 'addressbook-mongo',
                'database'  => 'addressbook',
                'options'  => array()
            )
        ));
    }
}

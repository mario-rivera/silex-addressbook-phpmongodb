<?php
namespace App\Routing;

use Pimple\ServiceProviderInterface;
use Pimple\Container;

class RouteServiceProvider implements ServiceProviderInterface{

    public function register(Container $app){

        $mounts = require_once __DIR__ . '/routing-mounts.php';
        foreach($mounts as $mountpoint => $controllerprovider){

            $app->mount( $mountpoint, new $controllerprovider );
        }
    }
}

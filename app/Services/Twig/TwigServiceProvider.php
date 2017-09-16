<?php
namespace App\Services\Twig;

use Pimple\ServiceProviderInterface;
use Pimple\Container;

use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigServiceProvider implements ServiceProviderInterface{

    public function register(Container $app){

        $loader = new Twig_Loader_Filesystem( rtrim($app['dir.app'], '/') . '/Views' );
        $twig = new Twig_Environment( $loader, ['cache' => false] );

        $app[Twig_Environment::class] = $twig;
    }
}

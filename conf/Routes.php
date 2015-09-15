<?php
namespace Conf;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class Routes
 * @package app
 */
class Routes
{
    /**
     * The list of routes.
     * @param $app
     */
    public static function configure($app)
    {
        $app["routes"] = $app->extend("routes", function (RouteCollection $routes) {
            $loader     = new YamlFileLoader(new FileLocator(__DIR__));
            $collection = $loader->load("routes.yml");
            $routes->addCollection($collection);
            return $routes;
        });
    }
}

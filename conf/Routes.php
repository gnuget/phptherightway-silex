<?php
namespace Conf;

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
        // Routes.
        $app->get('/', "posts:index");
        $app->get('/post/{id}', "posts:post");
        $app->get('/category/{category}', "posts:category");
    }
}

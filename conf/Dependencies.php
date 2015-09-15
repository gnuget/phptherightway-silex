<?php
namespace Conf;
use MyApp\Controller\Posts;

/**
 * Class Routes
 * @package app
 */
class Dependencies
{
    /**
     * The list of routes.
     * @param $app
     */
    public static function configure($app, $posts)
    {
        // DB Configuration.
        // More services.
        // Providers.

        // Dependencies.
        $app['posts'] = $app->share(function() use ($posts) {
            return new Posts($posts);
        });
    }
}

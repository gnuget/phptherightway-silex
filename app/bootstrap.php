<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../test_data.php';

use Silex\Application;
use MyApp\Controller\Posts;


$app = new Application();
$app['debug'] = true;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Dependencies.
$app['posts'] = $app->share(function() use ($posts) {
    return new Posts($posts);
});

// Routes.
$app->get('/', "posts:index");
$app->get('/post/{id}', "posts:post");
$app->get('/category/{category}', "posts:category");

$app->run();

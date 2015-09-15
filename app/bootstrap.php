<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../test_data.php';

use Silex\Application;

$app = new Application();
$app['debug'] = true;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
\Conf\Dependencies::configure($app, $posts);
\Conf\Routes::configure($app);
$app->run();

<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../test_data.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function () use ($posts) {
    $output = '';
    foreach ($posts as $key => $post) {
        $body = substr($post['body'],0, 50);
        $output .= "<div>";
        $output .= "<h1>{$post['title']}</h1>";
        $output .= "<span>{$post['author']}</span>";
        $output .= "<p>{$body}</p>";
        $output .= "</div>";
    }
    return $output;
});

$app->run();

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
        $output .= "<h1><a href=\"/post/{$key}\">{$post['title']}</a></h1>";
        $output .= "<span>{$post['author']}</span>";
        $output .= "<p>{$body}</p>";
        foreach ($post['categories'] as $category) {
            $output .= "<a href=\"/category/{$category}\">{$category}</a>&nbsp;";
        }
        $output .= "</div>";
    }
    return $output;
});

$app->get('/post/{id}', function (Silex\Application $app, $id) use ($posts) {
    if (!isset($posts[$id])) {
        $app->abort(404, "Post {$id} doesn't exist.");
    }
    $post = $posts[$id];
    $output = '';
    $output .= "<div>";
    $output .= "<h1>{$post['title']}</h1>";
    $output .= "<span>{$post['author']}</span>";
    $output .= "<p>{$post['body']}</p>";
    $output .= "<a href=\"/\">Back</a>";
    $output .= "</div>";
    return $output;
});

$app->get('/category/{category}', function (Silex\Application $app, $category) use ($posts) {
    $post_categories = [];
    foreach ($posts as $post) {
        if (in_array($category, $post['categories'])) {
            $post_categories[] = $post;
        }
    }
    $output = '';
    foreach ($post_categories as $key => $post) {
        $body = substr($post['body'],0, 50);
        $output .= "<div>";
        $output .= "<h1><a href=\"/post/{$key}\">{$post['title']}</a></h1>";
        $output .= "<span>{$post['author']}</span>";
        $output .= "<p>{$body}</p>";
        foreach ($post['categories'] as $category) {
            $output .= "<a href=\"/category/{$category}\">{$category}</a>&nbsp;";
        }
        $output .= "</div>";
    }
    return $output;
});
$app->run();

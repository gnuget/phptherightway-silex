<?php

namespace MyApp\Controller;
use Symfony\Component\HttpFoundation\Response;
use Silex;


/**
 * Class posts
 * @package MyApp\Controller
 */
class Posts {
    private $posts = [];

    public function __construct(Array $posts) {
        $this->posts = $posts;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $output = '';
        foreach ($this->posts as $key => $post) {
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
        return new Response($output);
    }

    /**
     * @param \Silex\Application $app
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function post(Silex\Application $app, $id) {
        if (!isset($this->posts[$id])) {
            $app->abort(404, "Post {$id} doesn't exist.");
        }
        $post = $this->posts[$id];
        $output = '';
        $output .= "<div>";
        $output .= "<h1>{$post['title']}</h1>";
        $output .= "<span>{$post['author']}</span>";
        $output .= "<p>{$post['body']}</p>";
        $output .= "<a href=\"/\">Back</a>";
        $output .= "</div>";
        return new Response($output);
    }

    /**
     * @param \Silex\Application $app
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function category(Silex\Application $app, $category) {
        $post_categories = [];
        foreach ($this->posts as $post) {
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
        return new Response($output);
    }
}

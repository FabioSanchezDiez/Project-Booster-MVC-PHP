<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {
        //$currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $currentUrl = strtok($_SERVER["REQUEST_URI"], "?") ?? "/";
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }


        if ( $fn ) {
            // call_user_func call a function that we don't know which is. 
            call_user_func($fn, $this); // $this is for pass arguments
        } else {
            echo "Page not found";
        }
    }

    public function render($view, $data = [])
    {

        // Read what we pass to the view
        foreach ($data as $key => $value) {
            $$key = $value;  // Double dollar sign means: variable variable, basically our variable remains the original one, but assigning it to another one doesn't rewrite it, it keeps its value, this way the variable name is dynamically assigned
        }

        ob_start(); // We start memory stored during a few moments...

        // and then include the view in layout
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Clean the buffer
        include_once __DIR__ . '/views/layout.php';
    }
}

<?php
namespace Core;

class Router {
    private $routes = [];

    public function add($method, $path, $callback) {
        $this->routes[strtoupper($method)][$path] = $callback;
    }

    public function dispatch($method, $path) {
        $method = strtoupper($method);
        if (isset($this->routes[$method][$path])) 
            call_user_func($this->routes[$method][$path]);
         else {
            http_response_code(404);
            echo '404 - Not Found';
        }
    }
}
?>
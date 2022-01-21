<?php

namespace Router;

use App\Controller\AppController;
use Router\Route;

class Router {
    public string $url;
    public array $routes = [];

    public function __construct(string $url)
    {
        $this->url = trim($url, '/');  
    } 

    public function get(string $path, string $action)
    { 
        $this->routes["GET"][] = new Route($path, $action);
    }
    public function post(string $path, string $action)
    { 
        $this->routes["POST"][] = new Route($path, $action);
    }

    public function run()
    { 
        $routeFound = false;

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->matches($this->url)) {
                $routeFound = true;
                $route->execute();
            }
        }

        if (!$routeFound) {
            return (new AppController())->error404();
        }
    }

    public static function redirect(string $url) {
        header("location: ". $_SERVER["REQUEST_SCHEME"]. "://". $_SERVER["HTTP_HOST"] .  "/" . $url);
        exit();
    }
}
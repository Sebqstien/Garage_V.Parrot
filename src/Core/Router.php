<?php

namespace App\Core;

use App\Controllers\ErrorController;

require_once '../Controllers/MainController.php';


class Router
{
    private $routes = [];

    public function addRoute($url, $controllerAction)
    {
        $this->routes[$url] = $controllerAction;
    }

    public function start()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (array_key_exists($url, $this->routes)) {
            $controllerAction = $this->routes[$url];
            [$controllerName, $actionName] = explode('@', $controllerAction);

            $controllerClassName = 'App\\Controllers\\' . $controllerName;
            $controller = new $controllerClassName();

            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                throw new \Exception("Action '$actionName' not found in controller '$controllerClassName'.");
            }
        } else {
            $errorController = new ErrorController;
            $errorController->error404();
        }
    }
}

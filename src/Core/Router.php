<?php

namespace App\Core;

use App\Controllers\ErrorController;

/**
 * Routeur de l'application
 */
class Router
{
    /**
     * Routes
     *
     * @var array
     */
    private array $routes = [];

    /**
     * Ajoute une route
     *
     * @param string $url
     * @param string $controllerAction
     * @return void
     */
    public function addRoute(string $url, string $controllerAction): void
    {
        $this->routes[$url] = $controllerAction;
    }

    /**
     * Demarre le routage
     *
     * @return void
     */
    public function start(): void
    {
        $url = $_SERVER['REQUEST_URI'];

        $matchedRoute = $this->matchRoute($url);

        if ($matchedRoute) {
            $controllerAction = $matchedRoute['controllerAction'];
            $params = $matchedRoute['params'];

            [$controllerName, $actionName] = explode('@', $controllerAction);

            $controllerClassName = 'App\\Controllers\\' . $controllerName;
            $controller = new $controllerClassName();

            if (method_exists($controller, $actionName)) {
                call_user_func_array([$controller, $actionName], array_values($params));
            } else {
                throw new \Exception("Action '$actionName' not found in controller '$controllerClassName'.");
            }
        } else {
            $errorController = new ErrorController;
            $errorController->error404();
        }
    }

/**
 * decompose l'url en controller / methodes.
 *
 * @param string $url
 * @return array|null
 */
    private function matchRoute(string $url): array|null
    {
        foreach ($this->routes as $route => $controllerAction) {
            $pattern = $this->convertRouteToRegex($route);
            if (preg_match($pattern, $url, $matches)) {
                $params = array_slice($matches, 1);
                return [
                    'controllerAction' => $controllerAction,
                    'params' => $params
                ];
            }
        }
        return null;
    }

    private function convertRouteToRegex($route)
    {
        $pattern = preg_replace('/\//', '\\/', $route);
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';
        return $pattern;
    }
}

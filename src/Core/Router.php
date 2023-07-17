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
     * Ajoute une route à la liste des routes du routeur.
     *
     * @param string $url               L'URL de la route.
     * @param string $controllerAction  L'action du contrôleur associée à la route (au format "NomDuControleur@nomDeLAction").
     * @return void
     */
    public function addRoute(string $url, string $controllerAction): void
    {
        $this->routes[$url] = $controllerAction;
    }

    /**
     * Démarre le routage de l'application en fonction de l'URL actuelle.
     *
     * @return void
     * @throws \Exception Si l'action spécifiée n'est pas trouvée dans le contrôleur correspondant.
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
     * Cherche une correspondance entre l'URL fournie et les routes enregistrées.
     *
     * @param string $url L'URL à rechercher.
     * @return array|null Les informations de la route correspondante sous forme de tableau associatif contenant les clés 'controllerAction' et 'params', ou null si aucune correspondance n'est trouvée.
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


    /**
     * Convertit une route en expression régulière.
     *
     * @param string $route La route à convertir.
     * @return string L'expression régulière correspondante.
     */
    private function convertRouteToRegex($route)
    {
        $pattern = preg_replace('/\//', '\\/', $route);
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';
        return $pattern;
    }
}

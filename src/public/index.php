<?php

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

use App\Controllers\AnnoncesController;
use App\Controllers\MainController;
use App\Core\Router;
use App\Models\GaragesModel;
use App\Models\UsersModel;

$router = new Router;


// routes:
$router->addRoute('/', 'MainController@index');
$router->addRoute('/annonces', 'AnnoncesController@index');
$router->addRoute('/avis', 'AvisController@index');
$router->addRoute("/annonces/{id}", 'AnnoncesController@show');
$router->addRoute("/admin", 'UsersController@login');
$router->addRoute("/dashboards", 'UsersController@login');


//Demarrage du Router
$router->start();

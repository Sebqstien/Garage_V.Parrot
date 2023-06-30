<?php

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

use App\Controllers\AnnoncesController;
use App\Controllers\MainController;
use App\Core\Router;
use App\Models\GaragesModel;

$router = new Router;


// routes:
$router->addRoute('/', 'MainController@index');
$router->addRoute('/annonces', 'AnnoncesController@index');
$router->addRoute('/avis', 'AvisController@index');
$router->addRoute("/annonces/{id}", 'AnnoncesController@show');


//Demarrage du Router
$router->start();


// $controller = new AnnoncesController;


// echo '<pre>';
// var_dump($controller);
// die;
// echo '</pre>';

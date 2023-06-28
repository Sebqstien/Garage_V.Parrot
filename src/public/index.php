<?php

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

use App\Core\Router;
use App\Models\AnnoncesModel;

$router = new Router;


// routes:
$router->addRoute('/', 'MainController@index');
$router->addRoute('/annonces', 'AnnoncesController@index');
$router->addRoute('/avis', 'AvisController@index');


//Demarrage du Router
$router->start();


// $model = new AnnoncesModel;

// $annonces = $model->findAll();
// echo "<pre>";
// var_dump($annonces);
// echo '</pre>';

<?php

session_start();

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

use App\Core\Router;


$router = new Router;


// routes:
$router->addRoute('/', 'MainController@index');
$router->addRoute('/annonces', 'AnnoncesController@index');
$router->addRoute('/avis', 'AvisController@index');
$router->addRoute("/annonces/{id}", 'AnnoncesController@show');
$router->addRoute("/login", 'UsersController@login');
$router->addRoute("/logout", 'UsersController@logout');
$router->addRoute("/dashboard", 'UsersController@dashboard');
$router->addRoute("/dashboard/create", 'AdminController@showForm');
$router->addRoute("/dashboard/edit/{id}", 'AdminController@showForm');
$router->addRoute("/dashboard/save", 'AdminController@save');
$router->addRoute("/dashboard/save/{id}", 'AdminController@save');
$router->addRoute("/dashboard/delete/{id}", 'AdminController@delete');




//Demarrage du Router
$router->start();

var_dump($_SESSION);
var_dump($_POST);

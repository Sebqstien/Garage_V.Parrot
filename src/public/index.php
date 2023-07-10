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
$router->addRoute("/login", 'Logincontroller@login');
$router->addRoute("/logout", 'Logincontroller@logout');
$router->addRoute("/dashboard", 'DashboardController@index');
$router->addRoute("/dashboard/users", 'DashboardController@index');
$router->addRoute("/dashboard/services", 'DashboardController@index');
$router->addRoute("/dashboard/users/create", 'DashboardController@showUserForm');
$router->addRoute("/dashboard/users/edit/{id}", 'DashboardController@showUserForm');
$router->addRoute("/dashboard/users/save", 'DashboardController@saveUser');
$router->addRoute("/dashboard/users/save/{id}", 'DashboardController@saveUser');
$router->addRoute("/dashboard/users/delete/{id}", 'DashboardController@deleteUser');
$router->addRoute("/dashboard/annonces/create", 'DashboardController@showAnnonceForm');
$router->addRoute("/dashboard/annonces/edit/{id}", 'DashboardController@showAnnonceForm');
$router->addRoute("/dashboard/annonces/save", 'DashboardController@createAnnonceAction');
$router->addRoute("/dashboard/annonces/save/{id}", 'DashboardController@editAnnonceAction');
$router->addRoute("/dashboard/annonces/delete/{id}", 'DashboardController@deleteAnnonceAction');
$router->addRoute("/dashboard/annonces/show/{id}", 'DashboardController@showImages');
$router->addRoute("/dashboard/annonces/images/save", 'DashboardController@saveImages');
$router->addRoute("/dashboard/annonces/images/delete/{id}", 'DashboardController@deleteImageAction');
$router->addRoute("/dashboard/annonces/images/update/{id}", 'DashboardController@updateImagesAction');
$router->addRoute("/dashboard/services/create", 'DashboardController@showServiceForm');
$router->addRoute("/dashboard/services/edit/{id}", 'DashboardController@showServiceForm');
$router->addRoute("/dashboard/services/save", 'DashboardController@createServiceAction');
$router->addRoute("/dashboard/services/save/{id}", 'DashboardController@editServiceAction');
$router->addRoute("/dashboard/services/delete/{id}", 'DashboardController@deleteServiceAction');





//Demarrage du Router
$router->start();

var_dump($_SESSION);
var_dump($_POST);

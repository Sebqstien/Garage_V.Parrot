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


//Dashboard Index
$router->addRoute("/dashboard", 'DashboardController@index');
$router->addRoute("/dashboard/users", 'DashboardController@index');
$router->addRoute("/dashboard/services", 'DashboardController@index');
$router->addRoute("/dashboard/informations", 'DashboardController@index');
$router->addRoute("/dashboard/garages", 'DashboardController@index');
$router->addRoute("/dashboard/horaires", 'DashboardController@index');


//Dashboard Users
$router->addRoute("/dashboard/users/create", 'DashboardController@showUserForm');
$router->addRoute("/dashboard/users/edit/{id}", 'DashboardController@showUserForm');
$router->addRoute("/dashboard/users/save", 'AnnoncesController@saveUser');
$router->addRoute("/dashboard/users/save/{id}", 'AnnoncesController@saveUser');
$router->addRoute("/dashboard/users/delete/{id}", 'AnnoncesController@deleteUser');


//Dashboard Annonces
$router->addRoute("/dashboard/annonces/create", 'DashboardController@showAnnonceForm');
$router->addRoute("/dashboard/annonces/edit/{id}", 'DashboardController@showAnnonceForm');
$router->addRoute("/dashboard/annonces/save", 'DashboardController@createAnnonceAction');
$router->addRoute("/dashboard/annonces/save/{id}", 'DashboardController@editAnnonceAction');
$router->addRoute("/dashboard/annonces/delete/{id}", 'DashboardController@deleteAnnonceAction');
$router->addRoute("/dashboard/annonces/show/{id}", 'DashboardController@showImages');
$router->addRoute("/dashboard/annonces/images/save", 'DashboardController@saveImages');
$router->addRoute("/dashboard/annonces/images/delete/{id}", 'DashboardController@deleteImageAction');
$router->addRoute("/dashboard/annonces/images/update/{id}", 'DashboardController@updateImagesAction');


//Dashboard Services
$router->addRoute("/dashboard/services/create", 'DashboardController@showServiceForm');
$router->addRoute("/dashboard/services/edit/{id}", 'DashboardController@showServiceForm');
$router->addRoute("/dashboard/services/save", 'DashboardController@createServiceAction');
$router->addRoute("/dashboard/services/save/{id}", 'DashboardController@editServiceAction');
$router->addRoute("/dashboard/services/delete/{id}", 'DashboardController@deleteServiceAction');


//Dashboard Garages
$router->addRoute("/dashboard/garages/create", 'DashboardController@showGarageForm');
$router->addRoute("/dashboard/garages/edit/{id}", 'DashboardController@showGarageForm');
$router->addRoute("/dashboard/garages/save/{id}", 'DashboardController@editGaragesAction');
$router->addRoute("/dashboard/garages/save", 'DashboardController@createGaragesAction');
$router->addRoute("/dashboard/garages/delete/{id}", 'DashboardController@deleteGaragesAction');


//Dahboard Horaires
$router->addRoute("/dashboard/horaires/edit/{id}", 'DashboardController@showHorairesForm');
$router->addRoute("/dashboard/horaires/save/{id}", 'HorairesController@editHorairesAction');









//Demarrage du Router
$router->start();

var_dump($_SESSION);
var_dump($_POST);

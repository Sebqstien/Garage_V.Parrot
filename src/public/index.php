<?php
session_start();

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

use App\Core\Router;


$router = new Router;


// routes:
$router->addRoute('/', 'MainController@index');
$router->addRoute('/annonces', 'AnnoncesController@index');
$router->addRoute("/annonces/{id}", 'AnnoncesController@show');
$router->addRoute('/avis', 'AvisController@index');
$router->addRoute("/contact", 'ContactController@index');
$router->addRoute("/mail", 'ContactController@envoyerMailAction');
$router->addRoute("/login", 'LoginController@login');
$router->addRoute("/logout", 'LoginController@logout');


//Dashboard Index
$router->addRoute("/dashboard", 'DashboardController@index');
$router->addRoute("/dashboard/users", 'DashboardController@index');
$router->addRoute("/dashboard/services", 'DashboardController@index');
$router->addRoute("/dashboard/informations", 'DashboardController@index');
$router->addRoute("/dashboard/garages", 'DashboardController@index');
$router->addRoute("/dashboard/horaires", 'DashboardController@index');
$router->addRoute("/dashboard/avis", 'DashboardController@index');

//Dashboard Users
$router->addRoute("/dashboard/users/create", 'DashboardController@showUserForm');
$router->addRoute("/dashboard/users/edit/{id}", 'DashboardController@showUserForm');

//Dashboard Annonces
$router->addRoute("/dashboard/annonces/create", 'DashboardController@showAnnonceForm');
$router->addRoute("/dashboard/annonces/edit/{id}", 'DashboardController@showAnnonceForm');


//Dashboard Images
$router->addRoute("/dashboard/annonces/show/{id}", 'DashboardController@showImages');
$router->addRoute("/dashboard/annonces/images/save", 'DashboardController@saveImages');

//Dashboard Services
$router->addRoute("/dashboard/services/create", 'DashboardController@showServiceForm');
$router->addRoute("/dashboard/services/edit/{id}", 'DashboardController@showServiceForm');

//Dashboard Garages
$router->addRoute("/dashboard/garages/create", 'DashboardController@showGarageForm');
$router->addRoute("/dashboard/garages/edit/{id}", 'DashboardController@showGarageForm');

//Dashboard horaire
$router->addRoute("/dashboard/horaires/edit/{id}", 'DashboardController@showHorairesForm');

//Dashboard Avis
$router->addRoute("/dashboard/avis/read/{id}", 'DashboardController@showAvis');
$router->addRoute("/dashboard/avis/create", 'DashboardController@showAvisForm');


// Users
$router->addRoute("/dashboard/users/save", 'UsersController@saveUser');
$router->addRoute("/dashboard/users/save/{id}", 'UsersController@saveUser');
$router->addRoute("/dashboard/users/delete/{id}", 'UserControllers@deleteUser');


// Annonces
$router->addRoute("/dashboard/annonces/save", 'AnnoncesController@createAnnonceAction');
$router->addRoute("/dashboard/annonces/save/{id}", 'AnnoncesController@editAnnonceAction');
$router->addRoute("/dashboard/annonces/delete/{id}", 'AnnoncesController@deleteAnnonceAction');


//Images
$router->addRoute("/dashboard/annonces/images/delete/{id}", 'ImagesController@deleteImageAction');
$router->addRoute("/dashboard/annonces/images/update/{id}", 'ImagesController@updateImagesAction');


// Services
$router->addRoute("/dashboard/services/save", 'ServiceController@createServiceAction');
$router->addRoute("/dashboard/services/save/{id}", 'ServiceController@editServiceAction');
$router->addRoute("/dashboard/services/delete/{id}", 'ServiceController@deleteServiceAction');


// Garages
$router->addRoute("/dashboard/garages/save/{id}", 'GaragesController@editGaragesAction');
$router->addRoute("/dashboard/garages/save", 'GaragesController@createGaragesAction');
$router->addRoute("/dashboard/garages/delete/{id}", 'GaragesController@deleteGaragesAction');


// Horaires
$router->addRoute("/dashboard/horaires/save/{id}", 'HorairesController@editHorairesAction');


//Avis
$router->addRoute("/dashboard/avis/delete/{id}", 'AvisController@deleteAvisAction');
$router->addRoute("/dashboard/avis/save", 'AvisController@createAvisAction');
$router->addRoute("/dashboard/avis/approved/{id}", 'AvisController@approvedAvisAction');





//Demarrage du Router
$router->start();

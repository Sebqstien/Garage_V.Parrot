<?php

namespace App\Controllers;

use App\Models\GaragesModel;
use App\Models\HorairesModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Controller abstrait
 */
abstract class Controller
{
    /**
     * Informations du garage
     *
     * @var array|null
     */
    protected ?array $garage;

    /**
     * Horaires du garage.
     *
     * @var array|null
     */
    protected ?array $horaires;




    /**
     * Constructeur
     */
    public function __construct()
    {
        $garageModel = new GaragesModel;
        $horairesModel = new HorairesModel;
        $this->horaires = $horairesModel->findAll();
        $this->garage = $garageModel->findAll();
    }

    /**
     * Recupere les informations du footer pour les injectes dans la vue.
     *
     * @return void
     */
    public function getFooterData()
    {
        $footerData = array(
            'garage' => $this->garage,
            'horaires' => $this->horaires
        );
        return $footerData;
    }

    /**
     * Twig
     *
     * @param string $fichier
     * @param array $donnees
     * @return void
     */
    public function render(string $fichier, array $donnees = []): void
    {
        $loader = new FilesystemLoader('../Views');
        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        echo $twig->render($fichier, $donnees);
    }



    public function redirect(string $route, int $http_code)
    {
        header('Status: 301 Moved Permanently', false, $http_code);
        header('Location: ' . $route);
    }
}

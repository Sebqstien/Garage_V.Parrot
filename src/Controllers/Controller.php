<?php

namespace App\Controllers;

use App\Models\GaragesModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Controller abstrait
 */
class Controller
{
    /**
     * Informations du garage
     *
     * @var array|null
     */
    protected ?array $garage;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $garageModel = new GaragesModel;
        $this->garage = $garageModel->findAll();
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
        echo $twig->render($fichier, $donnees);
    }
}

<?php

namespace App\Controllers;

use App\Models\GaragesModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Controller
{
    protected ?array $garage;

    public function __construct()
    {
        $garageModel = new GaragesModel;
        $this->garage = $garageModel->findAll();
    }


    public function render(string $fichier, array $donnees = [])
    {
        $loader = new FilesystemLoader('../Views');
        $twig = new Environment($loader);
        echo $twig->render($fichier, $donnees);
    }
}

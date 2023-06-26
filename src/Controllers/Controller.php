<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Controller
{

    public function render(string $fichier, ?array $donnees = [])
    {
        $loader = new FilesystemLoader('../Views');
        $twig = new Environment($loader);
        echo $twig->render($fichier, $donnees);
    }
}

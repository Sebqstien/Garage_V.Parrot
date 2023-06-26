<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


abstract class Controllers
{

    public function render(string $fichier, array $donnees = [])
    {
        $loader = new FilesystemLoader('../Views');
        $twig = new Environment($loader);
        return $twig->render($fichier);
    }
}

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
     * Recupere les informations du footer pour les injectes dans les vue.
     *
     * @return array|bool
     */
    public function getFooterData(): array|bool
    {
        $garagesModel = new GaragesModel;
        $informationsGarage = $garagesModel->findAll();
        $horairesModel = new HorairesModel;
        $horaires = $horairesModel->findAll();

        $footerData = array(
            'garage' => $informationsGarage,
            'horaires' => $horaires
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


    /**
     * Redirection Http
     *
     * @param string $route
     * @param integer $http_code
     * @return void
     */
    public function redirect(string $route, int $http_code)
    {
        header('Status: 301 Moved Permanently', false, $http_code);
        header('Location: ' . $route);
    }


    /**
     * Upload de un ou  plusieurs fichiers dans le dossier /upload.
     *
     * @param array $files
     * @return array
     */
    protected function upload(array $files): array
    {
        $uploaded = [];

        if (!empty($files['name'][0])) {
            $uploadDirectory = "upload/";


            for ($i = 0; $i < count($files['name']); $i++) {
                $filename = uniqid() . '_' . $files['name'][$i];
                $destination = $uploadDirectory . $filename;


                if (move_uploaded_file($files['tmp_name'][$i], $destination)) {
                    $uploaded[] = $destination;
                } else {
                    $_SESSION['erreur'] = "Erreur sur l'upload des images";
                    return false;
                }
            }
        }

        return $uploaded;
    }
}

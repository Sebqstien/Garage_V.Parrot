<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Models\ImagesModel;

/**
 * Controller de la table annonce.
 */
class AnnoncesController extends Controller
{

    /**
     * Recupere les donnees en BDD et genere la vue de la page des annonces.
     *
     * @return void
     */
    public function index(): void
    {
        $garage = $this->garage;
        $annoncesModel = new AnnoncesModel;
        $annonces = $annoncesModel->findAll();
        $this->render('annonces/index.html.twig', compact('annonces', 'garage'));
    }

    /**
     * Recupere les donnees en BDD et genere la vue de la page d'une annonce.
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id): void
    {
        if ($this->annonceExist($id) === true) {
            $garage = $this->garage;
            $annoncesModel = new AnnoncesModel;
            $imagesModel = new ImagesModel;
            $annonce = $annoncesModel->find($id);
            $images = $imagesModel->findBy("path_image", "id_voiture", $id);
            $this->render('annonces/show.html.twig', compact('annonce', 'images', 'garage'));
        } else {
            $errorController = new ErrorController;
            $errorController->error404();
        }
    }

    /**
     * Verifie en BDD si l'annonce existe.
     *
     * @param integer $id
     * @return void
     */
    private function annonceExist(int $id)
    {
        $annoncesModel = new AnnoncesModel;
        $annonce = $annoncesModel->find($id);

        return $annonce > 0;
    }
}

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
        $annoncesModel = new AnnoncesModel;
        $annonces = $annoncesModel->findAll();
        $footerData = $this->getFooterData();
        $this->render('annonces/index.html.twig', compact('annonces', 'footerData'));
    }

    /**
     * Recupere les donnees en BDD et genere la vue de la page d'une annonce.
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id): void
    {
        $footerData = $this->getFooterData();
        if ($this->annonceExist($id) === true) {
            $annoncesModel = new AnnoncesModel;
            $imagesModel = new ImagesModel;
            $annonce = $annoncesModel->find($id);
            $images = $imagesModel->findBy("path_image", "id_voiture", $id);
            $this->render('annonces/show.html.twig', [
                'annonce' => $annonce,
                'images' => $images,
                'footerData' => $footerData
            ]);
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

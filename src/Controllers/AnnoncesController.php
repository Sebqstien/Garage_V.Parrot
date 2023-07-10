<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

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
        $annonces = $annoncesModel->findAllAnnoncesWithImages();
        $footerData = $this->getFooterData();
        $this->render('annonces/index.html.twig', compact('annonces', 'footerData'));
    }
}

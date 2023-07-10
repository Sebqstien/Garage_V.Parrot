<?php

namespace App\Controllers;

use App\Models\AvisModel;

/**
 * Controller de la table avis.
 */
class AvisController extends Controller
{

    private AvisModel $avisModel;



    public function __construct()
    {
        $this->avisModel = new AvisModel;
    }

    /**
     * Recupere les donnees en BDD et genere la vue de la page d'avis clients.
     *
     * @return void
     */
    public function index(): void
    {
        $avis = $this->avisModel->findAll();
        $footerData = $this->getFooterData();
        $this->render('/avis/index.html.twig', [
            'footerData' => $footerData,
            'avis' => $avis
        ]);
    }
}

<?php

namespace App\Controllers;

/**
 * Controller de la table avis.
 */
class AvisController extends Controller
{
    /**
     * Recupere les donnees en BDD et genere la vue de la page d'avis clients.
     *
     * @return void
     */
    public function index(): void
    {
        $footerData = $this->getFooterData();
        $this->render('/avis/index.html.twig', [
            'footerData' => $footerData
        ]);
    }
}

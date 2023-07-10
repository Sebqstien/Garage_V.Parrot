<?php

namespace App\Controllers;

use App\Models\ServicesModel;

/**
 * Controller de la page d'accueil et des services.
 */
class MainController extends Controller
{
    /**
     * Recupere les donnees en BDD et genere la vue de la page d'accueil.
     *
     * @return void
     */
    public function index(): void
    {
        $footerData = $this->getFooterData();
        $servicesModel = new ServicesModel;
        $services = $servicesModel->findAll();
        $this->render('/main/index.html.twig', compact('services', 'footerData'));
    }
}

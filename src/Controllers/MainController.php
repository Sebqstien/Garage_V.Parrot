<?php

namespace App\Controllers;

use App\Models\AvisModel;
use App\Models\ServicesModel;

/**
 * Controller de la page d'accueil et des services.
 */
class MainController extends Controller
{

    private ServicesModel $servicesModel;
    private AvisModel $avisModel;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->servicesModel = new ServicesModel;
        $this->avisModel = new AvisModel;
    }


    /**
     * Recupere les donnees en BDD et genere la vue de la page d'accueil.
     *
     * @return void
     */
    public function index(): void
    {
        $footerData = $this->getFooterData();
        $services = $this->servicesModel->findAll();
        $avis = $this->avisModel->findAll();
        $this->render('/main/index.html.twig', compact('services', 'avis', 'footerData'));
    }
}

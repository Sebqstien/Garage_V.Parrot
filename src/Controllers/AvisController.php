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


    public function createAvisAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'note' => $_POST['note'] ?? '',
                'commentaire_avis' => $_POST['commentaire_avis'] ?? ''
            ];

            $this->avisModel->createAvis($data);

            $this->redirect('/dashboard/avis', 301);
            exit();
        }
    }


    public function deleteAvisAction(int $id): void
    {
        $this->avisModel->delete($id);

        $this->redirect('/dashboard/avis', 301);
        exit;
    }

    public function approvedAvisAction(int $id)
    {
        $this->avisModel->approvedAvis($id);

        $this->redirect('/dashboard/avis', 301);
        exit;
    }
}

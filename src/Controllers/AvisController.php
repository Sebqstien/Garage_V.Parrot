<?php

namespace App\Controllers;

use App\Models\AvisModel;

/**
 * Controller de la table avis.
 */
class AvisController extends Controller
{
    /**
     * Model des Avis
     *
     * @var AvisModel
     */
    private AvisModel $avisModel;


    /**
     * Constructeur
     */
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
        $avis = $this->avisModel->findBy('*', 'approved', 1);

        $this->render('/avis/index.html.twig', [
            'footerData' => $this->getFooterData(),
            'avis' => $avis
        ]);
    }


    /**
     * Creation d'un avis venant du formulaire du dashboard.
     *
     * @return void
     */
    public function createAvisAction(): void
    {
        var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'note' => $_POST['note'] ?? '',
                'commentaire_avis' => $_POST['commentaire_avis'] ?? ''
            ];

            $this->avisModel->createAvis($data);

            $this->redirect('/avis', 301);
            exit();
        }
    }

    /**
     * Suppression d'un avis client en BDD.
     *
     * @return void
     */
    public function deleteAvisAction(int $id): void
    {
        $this->avisModel->delete($id);

        $this->redirect('/dashboard/avis', 301);
        exit;
    }

    /**
     * Change l'avis en approved.
     *
     * @param integer $id
     * @return void
     */
    public function approvedAvisAction(int $id): void
    {

        $this->avisModel->approvedAvis($id);

        $this->redirect('/dashboard/avis', 301);
        exit;
    }
}

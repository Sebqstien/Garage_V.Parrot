<?php

namespace App\Controllers;

use App\Models\HorairesModel;

/**
 * Controleur des horaires du garage.
 */
class HorairesController extends Controller
{

    /**
     * Model des horaires du garages.
     *
     * @var HorairesModel
     */
    private HorairesModel $horairesModel;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->horairesModel = new HorairesModel();
    }


    /**
     * Modifie les horaires du garages en BDD en utilisant les donnees du formulaire Dashboard.
     *
     * @param integer $id
     * @return void
     */
    public function editHorairesAction(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'jours_ouverture' => $_POST['jours_ouverture'] ?? '',
                'heures_PM' => $_POST['heures_PM'] ?? '',
                'heures_AM' => $_POST['heures_AM'] ?? ''
            ];

            $this->horairesModel->editHoraires($id, $data);
            $this->redirect('/dashboard/horaires', 301);
            exit();
        }
    }
}

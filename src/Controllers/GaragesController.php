<?php

namespace App\Controllers;

use App\Models\GaragesModel;

/**
 * Controleur des Garages
 */
class GaragesController extends Controller
{
    /**
     * Model des Garages.
     *
     * @var GaragesModel
     */
    private GaragesModel $garageModel;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->garageModel = new GaragesModel();
    }


    /**
     * Creer un garage en BDD en utilant les donnees du formulaire du dashboard.
     *
     * @return void
     */
    public function createGaragesAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'adresse' => $_POST['adresse'] ?? ''
            ];

            $this->garageModel->createGarage($data);

            $this->redirect('/dashboard/garages', 301);
            exit();
        }
    }


    /**
     * Modifie un garage en BDD en utilisant les donnees du formulaire du dashboard.
     *
     * @param integer $id
     * @return void
     */
    public function editGaragesAction(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'adresse' => $_POST['adresse'] ?? ''
            ];

            $this->garageModel->updateGarage($id, $data);
            $this->redirect('/dashboard/garages', 301);
            exit();
        }
    }


    /**
     * Supprime un garage en BDD par l'action de l'admin sur le dashboard.
     *
     * @param integer $id
     * @return void
     */
    public function deleteGaragesAction(int $id): void
    {
        $this->garageModel->delete($id);

        $this->redirect('/dashboard/garages', 301);
        exit();
    }
}

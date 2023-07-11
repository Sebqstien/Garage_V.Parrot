<?php

namespace App\Controllers;

use App\Models\ServicesModel;

/**
 * Controleur des Services du garage.
 */
class ServicesController extends Controller
{

    /**
     * Model des Services du garage.
     *
     * @var ServicesModel
     */
    private ServicesModel $servicesModel;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
    }


    /**
     * Creation d'un service par le biais du formulaire dans le dashboard Admin.
     *
     * @return void
     */
    public function createServiceAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'titre' => $_POST['titre'] ?? '',
                'description' => $_POST['description'] ?? '',
                'prix' => $_POST['prix'] ?? ''
            ];

            $this->servicesModel->createService($data);

            $this->redirect('/dashboard/services', 301);
            exit();
        }
    }



    /**
     * Modification d'un service par le biais du formulaire dans le dashboard Admin.
     *
     * @param integer $id
     * @return void
     */
    public function editServiceAction(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'titre' => $_POST['titre'] ?? '',
                'description' => $_POST['description'] ?? '',
                'prix' => $_POST['prix'] ?? ''
            ];

            $this->servicesModel->updateService($id, $data);
            $this->redirect('/dashboard/services', 301);
            exit();
        }
    }


    /**
     * Suppression d'un service en BDD par l'action de l'Admin sur le dashboard.
     *
     * @param integer $id
     * @return void
     */
    public function deleteServiceAction(int $id): void
    {
        $this->servicesModel->delete($id);

        $this->redirect('/dashboard/services', 301);
        exit();
    }
}

<?php

namespace App\Controllers;

use App\Models\ServicesModel;


class ServicesController extends Controller
{

    private ServicesModel $servicesModel;

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
    }


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


    public function deleteServiceAction(int $id)
    {
        $this->servicesModel->delete($id);

        $this->redirect('/dashboard/services', 301);
        exit();
    }
}

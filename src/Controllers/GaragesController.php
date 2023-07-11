<?php

namespace App\Controllers;

use App\Models\GaragesModel;


class GaragesController extends Controller
{

    private GaragesModel $garageModel;

    public function __construct()
    {
        $this->garageModel = new GaragesModel();
    }


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


    public function deleteGaragesAction(int $id)
    {
        $this->garageModel->deleteGarage($id);

        $this->redirect('/dashboard/garages', 301);
        exit();
    }
}

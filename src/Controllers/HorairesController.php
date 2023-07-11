<?php

namespace App\Controllers;

use App\Models\HorairesModel;


class HorairesController extends Controller
{

    private HorairesModel $horairesModel;

    public function __construct()
    {
        $this->horairesModel = new HorairesModel();
    }


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

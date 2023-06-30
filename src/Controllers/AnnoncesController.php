<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Models\ImagesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        $garage = $this->garage;
        $annoncesModel = new AnnoncesModel;
        $annonces = $annoncesModel->findAll();
        $this->render('annonces/index.html.twig', compact('annonces', 'garage'));
    }

    public function show(int $id)
    {
        if ($this->annonceExist($id) === true) {
            $garage = $this->garage;
            $annoncesModel = new AnnoncesModel;
            $imagesModel = new ImagesModel;
            $annonce = $annoncesModel->find($id);
            $images = $imagesModel->findBy("path_image", "id_voiture", $id);
            $this->render('annonces/show.html.twig', compact('annonce', 'images', 'garage'));
        } else {
            $errorController = new ErrorController;
            $errorController->error404();
        }
    }

    private function annonceExist(int $id)
    {
        $annoncesModel = new AnnoncesModel;
        $annonce = $annoncesModel->find($id);

        return $annonce > 0;
    }
}

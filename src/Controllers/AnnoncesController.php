<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Models\ImagesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        $annoncesModel = new AnnoncesModel;
        $annonces = $annoncesModel->findAll();
        $this->render('annonces/index.html.twig', compact('annonces'));
    }

    public function show(int $id)
    {
        if ($this->annonceExist($id) === true) {
            $annoncesModel = new AnnoncesModel;
            $imagesModel = new ImagesModel;
            $annonce = $annoncesModel->find($id);
            $images = $imagesModel->findBy("path_image", "id_voiture", $id);
            $annonce = array_merge($annonce, compact('images'));
            $this->render('annonces/show.html.twig', compact('annonce', 'images'));
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

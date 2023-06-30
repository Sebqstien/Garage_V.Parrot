<?php

namespace App\Controllers;

use App\Models\ServicesModel;

class MainController extends Controller
{

    public function index()
    {
        $servicesModel = new ServicesModel;
        $services = $servicesModel->findAll();
        $garage = $this->garage;
        $this->render('/main/index.html.twig', compact('services', 'garage'));
    }
}

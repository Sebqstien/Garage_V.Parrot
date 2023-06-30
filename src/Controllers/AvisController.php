<?php

namespace App\Controllers;


class AvisController extends Controller
{
    public function index()
    {
        $garage = $this->garage;
        $this->render('/avis/index.html.twig', compact('garage'));
    }
}

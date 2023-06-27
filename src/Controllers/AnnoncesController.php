<?php

namespace App\Controllers;

class AnnoncesController extends Controller
{
    public function index()
    {
        $this->render('annonces/index.html.twig');
    }
}

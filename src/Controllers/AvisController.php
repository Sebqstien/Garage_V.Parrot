<?php

namespace App\Controllers;


class AvisController extends Controller
{
    public function index()
    {
        $this->render('/avis/index.html.twig');
    }
}

<?php

namespace App\Controllers;

/**
 * Controleur des erreurs.
 */
class ErrorController extends Controller
{
    /**
     * Genere une page 404
     *
     * @return void
     */
    public function error404()
    {
        http_response_code(404);
        $this->render('404.html.twig');
    }
}

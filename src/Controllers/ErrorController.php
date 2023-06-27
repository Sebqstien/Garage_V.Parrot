<?php

namespace App\Controllers;


class ErrorController extends Controller
{
    public function error404()
    {
        http_response_code(404);
        $this->render('404.html.twig');
    }

    public function handleError($errorMessage)
    {
        echo $errorMessage;
    }
}

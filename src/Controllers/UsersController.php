<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UsersModel;

/**
 * Controller de la table users
 */
class UsersController extends Controller
{
    //TODO: FINIR LES DOCS BLOCKS
    public function login()
    {
        $this->render('/admin/login.html.twig');
        $userModel = new UsersModel;
        $user = $userModel->findOneByEmail($_POST['email']);
        if ($user['password'] ===  $_POST['password'] && $user['is_admin'] === 1) {
            session_start();
            echo 'ok';
        } else {
            echo 'bad ';
        }
    }
}

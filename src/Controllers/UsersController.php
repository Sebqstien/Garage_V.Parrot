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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email'] && !empty($_POST['password']))) {

                $email = $_POST['email'];
                $password = $_POST['password'];
                $userModel = new UsersModel();

                $userArray = $userModel->findOneByEmail(strip_tags($email));

                if ($userArray && ($password === $userArray['password'])) { //TODO:hash MDP password_verify($password, $user['password'])

                    $user = $userModel->hydrate($userArray);
                    $user->setSession();
                    $this->redirect('/dashboard', 301);
                    exit;
                }
                echo "utilisateurs pas trouve";
            } else {

                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                $this->redirect('/login', 301);
                exit;
            }
        }

        $this->render('/admin/login.html.twig');
    }

    public function dashboard()
    {
        if (isset($_SESSION['user']) &&  $_SESSION['user']['is_admin'] === true) {
            $this->render('/admin/dashboards/admin.html.twig');
        } elseif (isset($_SESSION['user']) &&  $_SESSION['user']['is_admin'] === false) {
            $this->render('/admin/dashboards/employes.html.twig');
        } else {
            $this->redirect('/login', 301);
            $_SESSION['erreur'] = "Vous n'avez pas acces a cette zone";
        }
    }




    public function logout()
    {
        session_destroy();
        $this->redirect('/', 301);
        exit;
    }
}

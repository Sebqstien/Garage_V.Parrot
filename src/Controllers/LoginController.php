<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UsersModel;

/**
 * Controller de la table users
 */
class LoginController extends Controller
{

    private UsersModel $usersModel;


    public function __construct()
    {
        $this->usersModel = new UsersModel;
    }

    /**
     * Verifie le formulaire de connexion et redirige vers le dashboard selon le role de l'utilisateur.
     *
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                $email = $_POST['email'];
                $password = $_POST['password'];

                $userModel = new UsersModel;
                $userArray = $userModel->findOneByEmail($email);



                if ($userArray && (password_verify($password, $userArray['password']))) {



                    unset($_SESSION['erreur']);
                    $_SESSION['user'] = [
                        'nom' => $userArray['nom'],
                        'prenom' => $userArray['prenom'],
                        'email' => $userArray['email'],
                        'is_admin' => $userArray['is_admin']
                    ];

                    $this->redirect('/dashboard', 301);
                    exit;
                }
                $_SESSION['erreur'] = "Identifiants invalide";
            } else {

                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                $this->redirect('/login', 301);
                exit;
            }
        }

        $this->render('/admin/login.html.twig');
    }


    /**
     * Deconnexion de l'utilsateur.
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        $this->redirect('/', 301);
        exit;
    }
}

<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UsersModel;

/**
 * Controller du Login de l'application.
 */
class LoginController extends Controller
{

    /**
     * Model des Users pour recuperer les informations de connexion.
     *
     * @var UsersModel
     */
    private UsersModel $usersModel;


    /**
     * Constructeur
     */
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


                $userArray = $this->usersModel->findOneByEmail($email);



                if ($userArray && (password_verify($password, $userArray['password']))) {



                    unset($_SESSION['erreur']);
                    unset($_SESSION['success']);
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
     * Deconnexion de l'utilisateur.
     *
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
        $this->redirect('/', 301);
        exit;
    }
}

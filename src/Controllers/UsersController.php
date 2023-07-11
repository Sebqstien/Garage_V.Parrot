<?php

namespace App\Controllers;

use App\Models\UsersModel;


class UsersController extends Controller
{

    private UsersModel $usersModel;


    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }


    /**
     * Traite la creation/modification des utilisateurs.
     *
     * @param integer|null $id
     * @return void
     */
    public function saveUser(int $id = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['is_admin'] == true) {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'is_admin' => isset($_POST['isAdmin']) ? 1 : 0,
            ];

            if ($id) {
                $this->usersModel->editUser($id, $data);
            } else {
                $this->usersModel->createUser($data);
            }

            $this->redirect('/dashboard/users', 301);
            exit();
        }
    }

    /**
     * Supprime un utilisateur.
     *
     * @param integer $id utilisateur a supprimer
     * @return void
     */
    public function deleteUser(int $id): void
    {
        if ($_SESSION['user']['is_admin'] == true) {
            $this->usersModel->delete($id);
        }
        $this->redirect('/dashboard', 301);
        exit;
    }
}

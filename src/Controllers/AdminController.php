<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminController extends Controller
{
    private AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel;
    }

    /**
     * Genenre la vue du formulaire de creation ou de modification d'un utilisateur.
     *
     * @param integer|null $id en cas de modification.
     * @return void
     */
    public function showForm(int $id = null): void
    {
        if (isset($_SESSION['user']) &&  $_SESSION['user']['is_admin'] === true) {
            $user = ($id) ? $this->adminModel->find($id) : null;
            $this->render('/admin/form/userForm.html.twig', ['user' => $user]);
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }


    /**
     * Traite la creation/modification des utilisateurs.
     *
     * @param integer|null $id
     * @return void
     */
    public function save(int $id = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'is_admin' => isset($_POST['is_admin']) ? 1 : 0,
            ];

            if ($id) {
                $this->adminModel->edit($id, $data);
            } else {
                $this->adminModel->create($data);
            }

            $this->redirect('/dashboard', 301);
            exit();
        }
    }


    /**
     * Supprime un utilisateur.
     *
     * @param integer $id utilisateur a supprimer
     * @return void
     */
    public function delete(int $id): void
    {
        $this->adminModel->delete($id);

        $this->redirect('/dashboard', 301);
        exit;
    }
}

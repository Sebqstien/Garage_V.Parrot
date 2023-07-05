<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AdminController extends Controller
{
    private UsersModel $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel;
    }

    public function showForm(int $id = null): void
    {
        // Récupérer les données de l'utilisateur (si $id est fourni)
        $user = ($id) ? $this->userModel->find($id) : null;

        // Afficher le formulaire avec les données de l'utilisateur
        $this->render('/admin/form/form.html.twig', ['user' => $user]);
    }

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
                $this->userModel->edit($id, $data);
            } else {
                $this->userModel->create($data);
            }

            $this->redirect('/dashboard', 301);
            exit();
        }
    }

    public function delete(int $id): void
    {
        $this->userModel->delete($id);

        $this->redirect('/dashboard', 301);
        exit;
    }
}

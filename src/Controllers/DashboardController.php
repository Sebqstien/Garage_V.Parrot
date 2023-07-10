<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AnnoncesModel;
use App\Models\ImagesModel;

class DashboardController extends LoginController
{
    private UsersModel $usersModel;
    private AnnoncesModel $annoncesModel;
    private ImagesModel $imagesModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->annoncesModel = new AnnoncesModel();
        $this->imagesModel = new ImagesModel();
    }

    public function index()
    {
        unset($_SESSION['erreur']);


        if (isset($_SESSION['user'])) {
            $userEmail = $_SESSION['user']['email'];
            $user = $this->usersModel->findOneByEmail($userEmail);

            if ($user && $user['is_admin'] === 1) {
                $users = $this->usersModel->findAll();
                $annonces = $this->annoncesModel->findAllAnnoncesWithImages();


                if ($_SERVER['REQUEST_URI'] === '/dashboard/users') {
                    $this->render('/admin/dashboard.html.twig', [
                        'users' => $users,
                        'annonces' => $annonces,
                        'isAdmin' => true,
                        'currentTab' => 'users',
                        'user' => $user
                    ]);
                } else {

                    $this->render('/admin/dashboard.html.twig', [
                        'annonces' => $annonces,
                        'isAdmin' => true,
                        'currentTab' => 'annonces',
                        'user' => $user
                    ]);
                }
            } else {
                $annonces = $this->annoncesModel->findAllAnnoncesWithImages();

                $this->render('/admin/dashboard.html.twig', [
                    'annonces' => $annonces,
                    'isAdmin' => false,
                    'user' => $user,
                    'currentTab' => 'annonces',
                ]);
            }
        } else {
            $this->redirect('/login', 301);
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette zone";
        }
    }

    public function showImages(int $id): void
    {
        if (isset($_SESSION['user'])) {
            $annonce = $this->annoncesModel->find($id);
            $images = $this->imagesModel->findBy("path_image, id_image", "id_voiture", $id);
            $this->render('admin/showImages.html.twig', [
                'images' => $images,
                'annonce' => $annonce
            ]);
        }
    }


    /**
     * Genere la vue du formulaire de creation ou de modification d'un utilisateur.
     *
     * @param integer|null $id en cas de modification.
     * @return void
     */
    public function showUserForm(int $id = null): void
    {
        if ($_SESSION['user']['is_admin'] !== true) {
            $this->redirect('/', 301);
            exit;
        } else {
            $user = ($id) ? $this->usersModel->find($id) : null;
            $this->render('/admin/form/userForm.html.twig', ['user' => $user]);
        }
    }


    /**
     * Genere la vue du formulaire de creation ou de modification d'une annonces.
     *
     * @param integer|null $id en cas de modification.
     * @return void
     */
    public function showAnnonceForm(int $id = null): void
    {
        if (isset($_SESSION['user'])) {
            $annonce = ($id) ? $this->annoncesModel->find($id) : null;
            var_dump($annonce);
            $template = '/admin/form/annonceForm.html.twig';
            $this->render($template, ['annonce' => $annonce]);
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }


    public function createAnnonceAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titre' => $_POST['titre'] ?? '',
                'description' => $_POST['description'] ?? '',
                'marque' => $_POST['marque'] ?? '',
                'modele' => $_POST['modele'] ?? '',
                'carburant' => $_POST['carburant'] ?? '',
                'prix' => $_POST['prix'] ?? 0,
                'kilometrage' => $_POST['kilometrage'] ?? '',
                'annee' => $_POST['annee'] ?? '',
            ];


            if (!empty($_FILES['images']['name'][0])) {
                $images = $this->uploadImages($_FILES['images']);
                if ($images === false) {
                    $_SESSION['erreur'] = "Echec de l'upload des images";
                    $this->redirect('/dashboard/annonces/create', 301);
                    exit();
                }
            } else {
                $images = [];
            }

            $success = $this->annoncesModel->createAnnonce($data, $images);

            if ($success) {
                $this->redirect('/dashboard', 301);
                exit();
            } else {
                $_SESSION['erreur'] = "Erreur sur la creation de l'annonce";
                $this->redirect('/dashboard/annonces/create', 301);
                exit();
            }
        }

        $this->render('/admin/form/annonceForm.html.twig');
    }



    /**
     * Upload les images et renvoie les noms des fichiers uploadés.
     *
     * @param array $files Tableau des fichiers uploadés.
     * @return array|false Tableau des noms des fichiers uploadés ou false en cas d'erreur.
     */
    private function uploadImages(array $files): array
    {
        $uploadedImages = [];

        if (!empty($files['name'][0])) {
            $uploadDirectory = "upload/";


            for ($i = 0; $i < count($files['name']); $i++) {
                $filename = uniqid() . '_' . $files['name'][$i];
                $destination = $uploadDirectory . $filename;


                if (move_uploaded_file($files['tmp_name'][$i], $destination)) {
                    $uploadedImages[] = $destination;
                } else {
                    $_SESSION['erreur'] = "Erreur sur l'upload des images";
                    return false;
                }
            }
        }

        return $uploadedImages;
    }


    public function editAnnonceAction(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'titre' => $_POST['titre'] ?? '',
                'description' => $_POST['description'] ?? '',
                'marque' => $_POST['marque'] ?? '',
                'modele' => $_POST['modele'] ?? '',
                'carburant' => $_POST['carburant'] ?? '',
                'prix' => $_POST['prix'] ?? 0,
                'kilometrage' => $_POST['kilometrage'] ?? '',
                'annee' => $_POST['annee'] ?? '',
            ];

            $images = [];
            if (isset($_FILES['images'])) {
                $uploadedFiles = $_FILES['images'];
                for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
                    $imageName = $uploadedFiles['name'][$i];
                    $imageTmpName = $uploadedFiles['tmp_name'][$i];
                    $imagePath = '/upload' . $imageName;
                    move_uploaded_file($imageTmpName, $imagePath);
                    $images[] = $imagePath;
                }
            }

            $this->annoncesModel->updateAnnonce($id, $data, $images);

            $this->redirect('/dashboard', 301);
            exit();
        }

        $annonce = $this->annoncesModel->find($id);

        $this->render('/dashboard/annonces/edit/' . $annonce['id'], ['annonce' => $annonce]);
    }


    public function deleteAnnonceAction(int $id)
    {
        $this->annoncesModel->deleteAnnonceWithImages($id);

        $this->redirect('/dashboard', 301);
        exit();
    }

    public function deleteImageAction(int $id)
    {
        $imagesModel = new ImagesModel;
        $image = $imagesModel->findBy("*", "id_image", $id);

        if ($image) {
            $path = $image[0]['path_image'];

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $path);
            }

            $imagesModel->deleteImage($id);

            $annonceId = $image[0]['id_voiture'];
            $this->redirect('/dashboard/annonces/show/' . $annonceId, 301);
            exit();
        }

        $_SESSION['erreur'] = "L'image n'a pas été trouvée.";
        $this->redirect('/dashboard', 301);
        exit();
    }


    public function updateImagesAction(int $annonceId)
    {
        $imagesModel = new ImagesModel;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['new_images']['name'][0])) {
                $uploadedImages = $this->uploadImages($_FILES['new_images']);
                if ($uploadedImages === false) {
                    $_SESSION['erreur'] = "Echec de l'upload des nouvelles images";
                    $this->redirect("/dashboard/annonces/show/$annonceId", 301);
                    exit();
                }

                foreach ($uploadedImages as $newImage) {
                    $imagesModel->createImage([
                        'path_image' => $newImage,
                        'is_first' => 0,
                        'id_voiture' => $annonceId,
                    ]);
                }
            }

            $_SESSION['success'] = "Les nouvelles images ont été ajoutées avec succès";
            $this->redirect("/dashboard/annonces/show/$annonceId", 301);
            exit();
        }

        $_SESSION['erreur'] = "Aucune nouvelle image à ajouter";
        $this->redirect('/dashboard', 301);
        exit();
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
    public function deleteUser(int $id): void
    {
        if ($_SESSION['user']['is_admin'] == true) {
            $this->usersModel->delete($id);
        }
        $this->redirect('/dashboard', 301);
        exit;
    }
}
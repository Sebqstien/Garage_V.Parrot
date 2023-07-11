<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

/**
 * Controller de la table annonce.
 */
class AnnoncesController extends Controller
{

    private AnnoncesModel $annoncesModel;

    public function __construct()
    {
        $this->annoncesModel = new AnnoncesModel;
    }


    /**
     * Recupere les donnees en BDD et genere la vue de la page des annonces.
     *
     * @return void
     */
    public function index(): void
    {
        $annonces = $this->annoncesModel->findAllAnnoncesWithImages();
        $footerData = $this->getFooterData();
        $this->render('annonces/index.html.twig', compact('annonces', 'footerData'));
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
                $imagesController = new ImagesController;
                $images = $this->upload($_FILES['images']);
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
}

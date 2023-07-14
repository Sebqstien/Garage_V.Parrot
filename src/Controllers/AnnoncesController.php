<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

/**
 * Controller de la table annonce.
 */
class AnnoncesController extends Controller
{
    /**
     * Model des annonces
     *
     * @var AnnoncesModel
     */
    private AnnoncesModel $annoncesModel;


    /**
     * Constructeur
     */
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
        $this->render('annonces/index.html.twig', [
            'annonces' => $annonces,
            'footerData' => $this->getFooterData()
        ]);
    }


    /**
     * Recupere les donnees en BDD et genere la vue d'une annonce.
     *
     * @return void
     */
    public function show(int $id): void
    {
        $annonce = $this->annoncesModel->find($id);

        $this->render('annonces/show.html.twig', [
            'annonce' => $annonce,
            'footerData' => $this->getFooterData()
        ]);
    }

    /**
     * Creation des annonces venant du formulaire du dashboard.
     *
     * @return void
     */
    public function createAnnonceAction(): void
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

        $this->render('/admin/form/annonceForm.html.twig', [
            'footerData' => $this->getFooterData()
        ]);
    }


    /**
     * modification des annonces venant du formulaire du dashboard.
     *
     * @return void
     */
    public function editAnnonceAction(int $id): void
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

        $this->render('/dashboard/annonces/edit/' . $annonce['id'], [
            'annonce' => $annonce,
            'footerData' => $this->getFooterData()
        ]);
    }


    /**
     * Suppression d'une annonce et des ses images associees en BDD.
     *
     * @param integer $id
     * @return void
     */
    public function deleteAnnonceAction(int $id)
    {
        $this->annoncesModel->deleteAnnonceWithImages($id);

        $this->redirect('/dashboard', 301);
        exit();
    }


    /**
     * Filtres les annonces avec AJAX.
     *
     * @return void
     */
    public function filterAnnoncesAction()
    {
        $prixMin = $_POST['prixMin'] ?? 0;
        $prixMax = $_POST['prixMax'] ?? PHP_INT_MAX;
        $kilometresMin = $_POST['kilometresMin'] ?? 0;
        $kilometresMax = $_POST['kilometresMax'] ?? PHP_INT_MAX;
        $anneeMin = $_POST['anneeMin'] ?? 0;
        $anneeMax = $_POST['anneeMax'] ?? PHP_INT_MAX;
        $marque = $_POST['marque'] ?? null;
        $carburant = $_POST['carburant'] ?? null;

        $annonces = $this->annoncesModel->getFilteredAnnonces($prixMin, $prixMax, $kilometresMin, $kilometresMax, $anneeMin, $anneeMax, $marque, $carburant);

        return $annonces;
    }
}

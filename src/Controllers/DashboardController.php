<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AnnoncesModel;
use App\Models\AvisModel;
use App\Models\GaragesModel;
use App\Models\HorairesModel;
use App\Models\ImagesModel;
use App\Models\ServicesModel;

class DashboardController extends Controller
{
    private UsersModel $usersModel;
    private AnnoncesModel $annoncesModel;
    private ImagesModel $imagesModel;
    private ServicesModel $servicesModel;
    private HorairesModel $horairesModel;
    private GaragesModel $garageModel;
    private AvisModel $avisModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->annoncesModel = new AnnoncesModel();
        $this->imagesModel = new ImagesModel();
        $this->servicesModel = new ServicesModel();
        $this->horairesModel = new HorairesModel();
        $this->garageModel = new GaragesModel();
        $this->avisModel = new AvisModel();
    }

    public function index()
    {
        unset($_SESSION['erreur']);


        if (isset($_SESSION['user'])) {
            $userEmail = $_SESSION['user']['email'];
            $user = $this->usersModel->findOneByEmail($userEmail);
            $annonces = $this->annoncesModel->findAllAnnoncesWithImages();
            $avis = $this->avisModel->findBy('*', 'approved', 0);


            if ($user && $user['is_admin'] === 1) {
                $users = $this->usersModel->findAll();
                $services = $this->servicesModel->findAll();
                $garages = $this->garageModel->findAll();
                $horaires = $this->horairesModel->findAll();

                if ($_SERVER['REQUEST_URI'] === '/dashboard/users') {
                    $this->render('/admin/dashboard.html.twig', [
                        'users' => $users,
                        'annonces' => $annonces,
                        'isAdmin' => true,
                        'currentTab' => 'users',
                        'user' => $user
                    ]);
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/services') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'services' => $services,
                            'isAdmin' => true,
                            'currentTab' => 'services',
                            'user' => $user
                        ]
                    );
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/garages') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'garages' => $garages,
                            'isAdmin' => true,
                            'currentTab' => 'garages',
                            'user' => $user
                        ]
                    );
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/horaires') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'horaires' => $horaires,
                            'isAdmin' => true,
                            'currentTab' => 'horaires',
                            'user' => $user
                        ]
                    );
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/avis') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'avis' => $avis,
                            'isAdmin' => true,
                            'currentTab' => 'avis',
                            'user' => $user
                        ]
                    );
                } else {

                    $this->render('/admin/dashboard.html.twig', [
                        'annonces' => $annonces,
                        'isAdmin' => true,
                        'currentTab' => 'annonces',
                        'user' => $user
                    ]);
                }
            } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/avis') {
                $this->render('/admin/dashboard.html.twig', [
                    'avis' => $avis,
                    'user' => $user,
                    'currentTab' => 'avis',
                ]);
            } elseif ($_SERVER['REQUEST_URI'] === '/dashboard') {
                $this->render('/admin/dashboard.html.twig', [
                    'annonces' => $annonces,
                    'user' => $user,
                    'currentTab' => 'annonces',
                ]);
            }
        } else {
            $this->redirect('/login', 301);
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette zone";
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
        if ($_SESSION['user']['is_admin'] === 1) {
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
            $template = '/admin/form/annonceForm.html.twig';
            $this->render($template, ['annonce' => $annonce]);
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }


    /**
     * Genere la vue du formulaire de creation ou de modification d'un service.
     *
     * @param integer|null $id en cas de modification.
     * @return void
     */
    public function showServiceForm(int $id = null): void
    {
        if ($_SESSION['user']['is_admin'] == 1) {
            $service = ($id) ? $this->servicesModel->find($id) : null;

            $template = '/admin/form/serviceForm.html.twig';
            $this->render($template, ['service' => $service]);
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }


    /**
     * Genere la vue du formulaire de creation ou de modification d'un service.
     *
     * @param integer|null $id en cas de modification.
     * @return void
     */
    public function showGarageForm(int $id = null): void
    {
        if ($_SESSION['user']['is_admin'] == 1) {
            $garage = ($id) ? $this->garageModel->find($id) : null;

            $template = '/admin/form/garageForm.html.twig';
            $this->render($template, ['garage' => $garage]);
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }


    /**
     * Genere la vue du formulaire de creation ou de modification d'un service.
     *
     * @param integer|null $id en cas de modification.
     * @return void
     */
    public function showHorairesForm(int $id = null): void
    {
        if ($_SESSION['user']['is_admin'] == 1) {
            $horaires = $this->horairesModel->find($id);

            $template = '/admin/form/horairesForm.html.twig';
            $this->render($template, ['horaires' => $horaires]);
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }


    /**
     * Genere la vue du formulaire de creation d'un avis client.
     *
     * @return void
     */
    public function showAvisForm(): void
    {
        if ($_SESSION['user']) {

            $template = '/admin/form/avisForm.html.twig';
            $this->render($template);
        } else {
            $this->redirect('/', 301);
            exit;
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


    public function showAvis(int $id): void
    {
        if (isset($_SESSION['user'])) {
            $avis = $this->avisModel->findBy('*', 'approved', 0);
            var_dump($avis);
            $this->render('admin/showAvis.html.twig', [
                'avis' => $avis
            ]);
        }
    }
}

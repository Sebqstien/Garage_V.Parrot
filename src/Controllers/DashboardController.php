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
    /**
     * Model des Users
     *
     * @var UsersModel
     */
    private UsersModel $usersModel;

    /**
     * Model des Annonces
     *
     * @var AnnoncesModel
     */
    private AnnoncesModel $annoncesModel;

    /**
     * Model des Images
     *
     * @var ImagesModel
     */
    private ImagesModel $imagesModel;

    /**
     * Model des services
     *
     * @var ServicesModel
     */
    private ServicesModel $servicesModel;

    /**
     * Model des Horaires
     *
     * @var HorairesModel
     */
    private HorairesModel $horairesModel;

    /**
     * Model des Garages
     *
     * @var GaragesModel
     */
    private GaragesModel $garageModel;

    /**
     * Model des Avis
     *
     * @var AvisModel
     */
    private AvisModel $avisModel;

    /**
     * Donnees a injecter dans le footer
     *
     * @var array
     */
    private array $footerData;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->annoncesModel = new AnnoncesModel();
        $this->imagesModel = new ImagesModel();
        $this->servicesModel = new ServicesModel();
        $this->horairesModel = new HorairesModel();
        $this->garageModel = new GaragesModel();
        $this->avisModel = new AvisModel();
        $this->footerData = $this->getFooterData();
    }


    /**
     * Affiche la page d'index du dashboard
     *
     * @return void
     */
    public function index(): void
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
                        'user' => $user,
                        'footerData' => $this->footerData
                    ]);
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/services') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'services' => $services,
                            'isAdmin' => true,
                            'currentTab' => 'services',
                            'user' => $user,
                            'footerData' => $this->footerData
                        ]
                    );
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/garages') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'garages' => $garages,
                            'isAdmin' => true,
                            'currentTab' => 'garages',
                            'user' => $user,
                            'footerData' => $this->footerData
                        ]
                    );
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/horaires') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'horaires' => $horaires,
                            'isAdmin' => true,
                            'currentTab' => 'horaires',
                            'user' => $user,
                            'footerData' => $this->footerData
                        ]
                    );
                } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/avis') {
                    $this->render(
                        '/admin/dashboard.html.twig',
                        [
                            'avis' => $avis,
                            'isAdmin' => true,
                            'currentTab' => 'avis',
                            'user' => $user,
                            'footerData' => $this->footerData
                        ]
                    );
                } else {

                    $this->render('/admin/dashboard.html.twig', [
                        'annonces' => $annonces,
                        'isAdmin' => true,
                        'currentTab' => 'annonces',
                        'user' => $user,
                        'footerData' => $this->footerData
                    ]);
                }
            } elseif ($_SERVER['REQUEST_URI'] === '/dashboard/avis') {
                $this->render('/admin/dashboard.html.twig', [
                    'avis' => $avis,
                    'user' => $user,
                    'currentTab' => 'avis',
                    'footerData' => $this->footerData
                ]);
            } elseif ($_SERVER['REQUEST_URI'] === '/dashboard') {
                $this->render('/admin/dashboard.html.twig', [
                    'annonces' => $annonces,
                    'user' => $user,
                    'currentTab' => 'annonces',
                    'footerData' => $this->footerData
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
            $user = ($id) ? $this->usersModel->find($id) : null;
            $this->render('/admin/form/userForm.html.twig', [
                'footerData' => $this->footerData,
                'user' => $user
            ]);
        } else {
            $this->redirect('/', 301);
            exit;
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
            $this->render($template, [
                'annonce' => $annonce,
                'footerData' => $this->footerData
            ]);
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
            $this->render($template, [
                'service' => $service,
                'footerData' => $this->footerData,
            ]);
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
            $this->render($template, [
                'garage' => $garage,
                'footerData' => $this->footerData,
            ]);
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
            $this->render($template, [
                'horaires' => $horaires,
                'footerData' => $this->footerData
            ]);
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
            $this->render(
                $template,
                ['footerData' => $this->footerData]
            );
        } else {
            $this->redirect('/', 301);
            exit;
        }
    }

    /**
     * Genere la page d'affichage des Images associees a une annonce.
     *
     * @param integer $id
     * @return void
     */
    public function showImages(int $id): void
    {
        if (isset($_SESSION['user'])) {
            $annonce = $this->annoncesModel->find($id);
            $images = $this->imagesModel->findBy("path_image, id_image", "id_voiture", $id);
            $this->render('admin/showImages.html.twig', [
                'images' => $images,
                'annonce' => $annonce,
                'footerData' => $this->footerData
            ]);
        }
    }


    /**
     * Affiche la page de moderation des Avis clients.
     *
     * @return void
     */
    public function showAvis(): void
    {
        if (isset($_SESSION['user'])) {
            $avis = $this->avisModel->findBy('*', 'approved', 0);
            $this->render('admin/showAvis.html.twig', [
                'avis' => $avis,
                'footerData' => $this->footerData,
            ]);
        }
    }
}

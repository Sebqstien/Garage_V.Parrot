<?php

namespace App\Controllers;

use App\Models\ImagesModel;


class ImagesController extends Controller
{


    public function updateImagesAction(int $annonceId)
    {
        $imagesModel = new ImagesModel;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['new_images']['name'][0])) {
                $uploadedImages = $this->upload($_FILES['new_images']);
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

    public function deleteImageAction(int $id)
    {
        $imagesModel = new ImagesModel;
        $image = $imagesModel->findBy("*", "id_image", $id);

        if ($image) {
            $path = $image[0]['path_image'];

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $path);
            }

            $imagesModel->delete($id);

            $annonceId = $image[0]['id_voiture'];
            $this->redirect('/dashboard/annonces/show/' . $annonceId, 301);
            exit();
        }

        $_SESSION['erreur'] = "L'image n'a pas été trouvée.";
        $this->redirect('/dashboard', 301);
        exit();
    }
}

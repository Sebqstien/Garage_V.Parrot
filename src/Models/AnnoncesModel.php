<?php

namespace App\Models;

use PDO;
use App\Core\Database;

/**
 * Echange de Donnees avec la table Annonces de la BDD
 */
class AnnoncesModel extends Model
{


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "annonces";
    }

    public function findAllAnnoncesWithImages(): array
    {
        $sql = "SELECT annonces.*, images.path_image
                FROM annonces
                LEFT JOIN images ON annonces.id = images.id_voiture
                ORDER BY annonces.id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $annonces = [];
        $currentAnnonce = null;

        foreach ($result as $row) {
            $annonceId = $row['id'];

            if (!$currentAnnonce || $currentAnnonce['id'] !== $annonceId) {
                if ($currentAnnonce) {
                    $annonces[] = $currentAnnonce;
                }

                $currentAnnonce = [
                    'id' => $annonceId,
                    'titre' => $row['titre'],
                    'description' => $row['description'],
                    'marque' => $row['marque'],
                    'modele' => $row['modele'],
                    'carburant' => $row['carburant'],
                    'prix' => $row['prix'],
                    'kilometrage' => $row['kilometrage'],
                    'images' => [],
                ];
            }

            if ($row['path_image']) {
                $currentAnnonce['images'][] = $row['path_image'];
            }
        }

        if ($currentAnnonce) {
            $annonces[] = $currentAnnonce;
        }

        return $annonces;
    }




    /**
     * Insere une annonce et ses images associees en BDD.
     *
     * @param array $data Data des annonces a creer dans la BDD.
     * @param array $images Tableau des images de l'annonce.
     * @return bool Retourne true si la création est réussie, sinon false.
     */
    public function createAnnonce(array $data, array $images): bool
    {
        $sql = "INSERT INTO annonces (titre, description, marque, modele, carburant, prix, kilometrage, annee)
            VALUES (:titre, :description, :marque, :modele, :carburant, :prix, :kilometrage, :annee)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'titre' => $data['titre'],
            'description' => $data['description'],
            'marque' => $data['marque'],
            'modele' => $data['modele'],
            'carburant' => $data['carburant'],
            'prix' => $data['prix'],
            'kilometrage' => $data['kilometrage'],
            'annee' => $data['annee'],
        ]);

        $annonceId = Database::getInstance()->lastInsertId();

        $sql = "INSERT INTO images (path_image, id_voiture) VALUES (:path, :voitureId)";
        $query = Database::getInstance()->prepare($sql);

        foreach ($images as $image) {
            $query->execute([
                'path' => $image,
                'voitureId' => $annonceId,
            ]);
        }

        return true;
    }

    /**
     * Modifie une annonce et les images associees en BDD.
     *
     * @param integer $annonceId
     * @param array $data
     * @param array $images
     * @return boolean
     */
    public function updateAnnonce(int $annonceId, array $data, array $images): bool
    {
        $sql = "UPDATE annonces
            SET titre = :titre, description = :description, marque = :marque, modele = :modele, carburant = :carburant,
                prix = :prix, kilometrage = :kilometrage, annee = :annee
            WHERE id = :annonceId";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'titre' => $data['titre'],
            'description' => $data['description'],
            'marque' => $data['marque'],
            'modele' => $data['modele'],
            'carburant' => $data['carburant'],
            'prix' => $data['prix'],
            'kilometrage' => $data['kilometrage'],
            'annee' => $data['annee'],
            'annonceId' => $annonceId,
        ]);

        $sql = "DELETE FROM images WHERE id_voiture = :annonceId";
        $query = Database::getInstance()->prepare($sql);
        $query->execute(['annonceId' => $annonceId]);

        $sql = "INSERT INTO images (path_image, id_voiture) VALUES (:path, :voitureId)";
        $query = Database::getInstance()->prepare($sql);

        foreach ($images as $image) {
            $query->execute([
                'path' => $image,
                'voitureId' => $annonceId,
            ]);
        }

        return true;
    }

    /**
     * Supprime une annonce et les images associees.
     *
     * @param integer $annonceId
     * @return boolean
     */
    public function deleteAnnonceWithImages(int $annonceId): bool
    {
        $sql = "SELECT path_image FROM images WHERE id_voiture = :annonceId";
        $query = Database::getInstance()->prepare($sql);
        $query->execute(['annonceId' => $annonceId]);
        $images = $query->fetchAll(PDO::FETCH_COLUMN);

        foreach ($images as $image) {
            $path = 'upload/' . $image;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $sql = "DELETE FROM images WHERE id_voiture = :annonceId";
        $query = Database::getInstance()->prepare($sql);
        $query->execute(['annonceId' => $annonceId]);

        $sql = "DELETE FROM annonces WHERE id = :annonceId";
        $query = Database::getInstance()->prepare($sql);
        $query->execute(['annonceId' => $annonceId]);

        return true;
    }
}

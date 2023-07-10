<?php

namespace App\Models;

use App\Core\Database;


/**
 * Échange de Données avec la table images de la BDD
 */
class ImagesModel extends Model
{
    /**
     * Clé primaire
     *
     * @var integer
     */
    private int $id_image;

    /**
     * Chemin de l'image stockée.
     *
     * @var string
     */
    private string $path_image;

    /**
     * Clé étrangère reliée à la clé primaire de la table annonce.
     *
     * @var integer
     */
    private int $id_voiture;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "images";
    }


    /**
     * Crée une nouvelle image dans la base de données.
     *
     * @param array $data Les données de l'image à insérer.
     * @return bool Indique si l'opération d'insertion a réussi ou échoué.
     */
    public function createImage(array $data): bool
    {
        $sql = "INSERT INTO images (path_image, id_voiture) VALUES (:path, :voitureId)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'path' => $data['path_image'],
            'voitureId' => $data['id_voiture']
        ]);

        return $query->rowCount() > 0;
    }



    /**
     * Supprime une entrée d'image en BDD
     *
     * @param int $id
     * @return bool
     */
    public function deleteImage(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id_image = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute(['id' => $id]);
        return true;
    }


    /**
     * update une image en BDD
     *
     * @param array $data
     * @return bool
     */
    public function updateImage(array $data): bool
    {
        $sql = "UPDATE {$this->table} SET path_image = :path_image WHERE id_image = :id_image";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'path_image' => $data['path_image'],
            'id_image' => $data['id_image'],
        ]);

        return true;
    }



    /**
     * Get the value of id_image
     */
    public function getId_image(): int
    {
        return $this->id_image;
    }


    /**
     * Set the value of id_image
     *
     * @param int $id_image
     * @return self
     */
    public function setId_image(int $id_image): self
    {
        $this->id_image = $id_image;
        return $this;
    }

    /**
     * Get the value of path_image
     */
    public function getPath_image(): string
    {
        return $this->path_image;
    }

    /**
     * Set the value of path_image
     *
     * @param string $path_image
     * @return self
     */
    public function setPath_image(string $path_image): self
    {
        $this->path_image = $path_image;
        return $this;
    }

    /**
     * Get the value of id_voiture
     */
    public function getId_voiture(): int
    {
        return $this->id_voiture;
    }

    /**
     * Set the value of id_voiture
     *
     * @param int $id_voiture
     * @return self
     */
    public function setId_voiture(int $id_voiture): self
    {
        $this->id_voiture = $id_voiture;
        return $this;
    }
}

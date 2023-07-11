<?php

namespace App\Models;

use App\Core\Database;

/**
 * Echange de Donnees avec la table Services de la BDD
 */
class ServicesModel extends Model
{


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "services";
    }


    public function createService(array $data): bool
    {
        $sql = "INSERT INTO $this->table (titre, description, prix) VALUES (:titre, :description, :prix)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'titre' => $data['titre'],
            'description' => $data['description'],
            'prix' => $data['prix'],
        ]);

        return $query->rowCount() > 0;
    }

    public function updateService(int $id, array $data): bool
    {
        $sql = "UPDATE $this->table SET titre = :titre, description = :description, prix = :prix WHERE id = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'id' => $id,
            'titre' => $data['titre'],
            'description' => $data['description'],
            'prix' => $data['prix'],
        ]);

        return $query->rowCount() > 0;
    }
}

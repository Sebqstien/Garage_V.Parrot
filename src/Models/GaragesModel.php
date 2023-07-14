<?php

namespace App\Models;

use App\Core\Database;

/**
 * Echange de Donnees avec la table Garages de la BDD
 */
class GaragesModel extends Model
{


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = 'garages';
    }


    /**
     * Cree en BDD un Garage dans la table Garages.
     *
     * @param array $data
     * @return boolean
     */
    public function createGarage(array $data): bool
    {
        $sql = "INSERT INTO $this->table (nom, email, telephone, adresse) VALUES (:nom, :email, :telephone, :adresse)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse']
        ]);

        return $query->rowCount() > 0;
    }


    /**
     * Modifie un garage de la table Grages en BDD.
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function updateGarage(int $id, array $data): bool
    {
        $sql = "UPDATE $this->table SET nom = :nom, email = :email, telephone = :telephone, adresse = :adresse WHERE id = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'id' => $id,
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['prixtelephone'],
            'adresse' => $data['adresse']
        ]);

        return $query->rowCount() > 0;
    }
}

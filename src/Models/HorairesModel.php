<?php

namespace App\Models;

use App\Core\Database;

/**
 * Echange de Donnees avec la table horaires de la BDD
 */
class HorairesModel extends Model
{

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = 'horaires';
    }


    /**
     * Edit la table horaires dans la BDD
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function editHoraires(int $id, array $data): bool
    {
        $sql = "UPDATE $this->table SET jours_ouverture = :jours_ouverture, heures_PM = :heures_PM, heures_AM = :heures_AM WHERE id = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'id' => $id,
            'jours_ouverture' => $data['jours_ouverture'],
            'heures_PM' => $data['heures_PM'],
            'heures_AM' => $data['heures_AM']
        ]);

        return $query->rowCount() > 0;
    }
}

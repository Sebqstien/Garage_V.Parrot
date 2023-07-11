<?php

namespace App\Models;

use App\Core\Database;

/**
 * Echange de Donnees avec la table Avis de la BDD
 */
class AvisModel extends Model
{


    /**
     * constructeur
     */
    public function __construct()
    {
        $this->table = "avis";
    }


    public function createAvis(array $data): bool
    {
        $sql = "INSERT INTO $this->table (nom, note, commentaire_avis) VALUES (:nom, :note, :commentaire_avis)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'nom' => $data['nom'],
            'note' => $data['note'],
            'commentaire_avis' => $data['commentaire_avis'],
        ]);

        return $query->rowCount() > 0;
    }
}

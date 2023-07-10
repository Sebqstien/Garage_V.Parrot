<?php

namespace App\Models;

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
}

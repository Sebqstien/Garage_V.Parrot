<?php

namespace App\Models;

/**
 * Echange de Donnees avec la table horaires de la BDD
 */
class InformationsModel extends Model
{
    /**
     * Cle primaire
     *
     * @var integer
     */
    private int $id;

    /**
     * Jour d'ouverture du garage
     *
     * @var string
     */
    private string $jours_ouverture;

    /**
     * Heures d'ouverture matin du garage
     *
     * @var string|null
     */
    private ?string $heures_PM;

    /**
     * Heure d'ouverture apres-midi du garage
     *
     * @var string|null
     */
    private ?string $heures_AM;

    public function __construct()
    {
        $this->table = "horaires";
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of jours_ouverture
     */
    public function getJours_ouverture()
    {
        return $this->jours_ouverture;
    }

    /**
     * Set the value of jours_ouverture
     *
     * @return  self
     */
    public function setJours_ouverture($jours_ouverture)
    {
        $this->jours_ouverture = $jours_ouverture;

        return $this;
    }

    /**
     * Get the value of heures_PM
     */
    public function getHeures_PM()
    {
        return $this->heures_PM;
    }

    /**
     * Set the value of heures_PM
     *
     * @return  self
     */
    public function setHeures_PM($heures_PM)
    {
        $this->heures_PM = $heures_PM;

        return $this;
    }

    /**
     * Get the value of heures_AM
     */
    public function getHeures_AM()
    {
        return $this->heures_AM;
    }

    /**
     * Set the value of heures_AM
     *
     * @return  self
     */
    public function setHeures_AM($heures_AM)
    {
        $this->heures_AM = $heures_AM;

        return $this;
    }
}

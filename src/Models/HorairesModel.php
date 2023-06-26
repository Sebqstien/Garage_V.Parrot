<?php

namespace App\Models;

class HorairesModel extends Model
{
    private int $id;
    private string $jour_ouverture;
    private string $heure_ouverture;
    private string $heure_fermeture;

    public function __construct()
    {
        $this->table = 'horaires';
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of jour_ouverture
     */
    public function getJour_ouverture()
    {
        return $this->jour_ouverture;
    }

    /**
     * Set the value of jour_ouverture
     *
     * @return  self
     */
    public function setJour_ouverture($jour_ouverture)
    {
        $this->jour_ouverture = $jour_ouverture;

        return $this;
    }

    /**
     * Get the value of heure_ouverture
     */
    public function getHeure_ouverture()
    {
        return $this->heure_ouverture;
    }

    /**
     * Set the value of heure_ouverture
     *
     * @return  self
     */
    public function setHeure_ouverture($heure_ouverture)
    {
        $this->heure_ouverture = $heure_ouverture;

        return $this;
    }

    /**
     * Get the value of heure_fermeture
     */
    public function getHeure_fermeture()
    {
        return $this->heure_fermeture;
    }

    /**
     * Set the value of heure_fermeture
     *
     * @return  self
     */
    public function setHeure_fermeture($heure_fermeture)
    {
        $this->heure_fermeture = $heure_fermeture;

        return $this;
    }
}

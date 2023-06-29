<?php

namespace App\Models;

class InformationsModel extends Model
{
    private int $id;
    private ?string $adresse;
    private ?string $telephone;
    private ?string $email;
    private ?string $jour_ouverture;
    private ?string $heure_ouverture;
    private ?string $heure_fermeture;
    private int $id_garage;

    public function __construct()
    {
        $this->table = "informations";
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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

    /**
     * Get the value of id_garage
     */
    public function getId_garage(GaragesModel $garagesModel)
    {
        return $garagesModel->getId();
    }

    /**
     * Set the value of id_garage
     *
     * @return  self
     */
    public function setId_garage(GaragesModel $garagesModel)
    {
        $this->id_garage = $garagesModel->getId();

        return $this;
    }
}

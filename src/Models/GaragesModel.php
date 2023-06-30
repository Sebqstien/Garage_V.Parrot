<?php

namespace App\Models;

/**
 * Echange de Donnees avec la table Garages de la BDD
 */
class GaragesModel extends Model
{
    /**
     * Cle primaire
     *
     * @var integer
     */
    private int $id;

    /**
     * Nom du garage
     *
     * @var string
     */
    private string $nom;

    /**
     * Email du garage
     *
     * @var string
     */
    private string $email;

    /**
     * Telephone du garage
     *
     * @var integer
     */
    private int $telephone;

    /**
     * Adresse du garage
     *
     * @var string
     */
    private string $adresse;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = 'garages';
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
}

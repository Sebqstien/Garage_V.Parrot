<?php

namespace App\Models;

/**
 * Echange de Donnees avec la table Services de la BDD
 */
class ServicesModel extends Model
{
    /**
     * Cle primaire
     *
     * @var integer
     */
    private int $id;

    /**
     * Titre du service.
     *
     * @var string
     */
    private string $titre;

    /**
     * Description du service
     *
     * @var string
     */
    private string $description;

    /**
     * Prix du service
     *
     * @var float
     */
    private float $prix;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "services";
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }
}

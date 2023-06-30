<?php

namespace App\Models;

/**
 * Echange de Donnees avec la table Annonces de la BDD
 */
class AnnoncesModel extends Model
{
    /**
     * Cle primaire
     *
     * @var integer
     */
    private int $id;

    /**
     * Titre de l'annonce
     *
     * @var string
     */
    private string $titre;

    /**
     * Description de l'annonce
     *
     * @var string|null
     */
    private ?string $description;

    /**
     * marque du vehicule
     *
     * @var string|null
     */
    private ?string $marque;

    /**
     * Modele du vehicule
     *
     * @var string|null
     */
    private ?string $modele;

    /**
     * Type carburant du vehicule
     *
     * @var string|null
     */
    private ?string $carburant;

    /**
     * Prix du vehicule
     *
     * @var string
     */
    private string $prix;

    /**
     * Kilometrage du vehicule
     *
     * @var string
     */
    private string $kilometrage;

    /**
     * Annee de mise encirculation du vehicule
     *
     * @var string|null
     */
    private ?string $annee;

    /**
     * Date de creation de l'annonce
     *
     * @var string|null
     */
    protected ?string $created_at;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "annonces";
        $this->jointure = " INNER JOIN images ON annonces.id = images.id_voiture";
        $this->options = " WHERE is_first = 1 ORDER BY created_at DESC;";
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
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Get the value of marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set the value of marque
     *
     * @return  self
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get the value of modele
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get the value of carburant
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * Set the value of carburant
     *
     * @return  self
     */
    public function setCarburant($carburant)
    {
        $this->carburant = $carburant;

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

    /**
     * Get kilometrage du vehicule
     *
     * @return  string
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * Set kilometrage du vehicule
     *
     * @param  string  $kilometrage  Kilometrage du vehicule
     *
     * @return  self
     */
    public function setKilometrage(string $kilometrage)
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    /**
     * Get annee de mise encirculation du vehicule
     *
     * @return  string|null
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set annee de mise encirculation du vehicule
     *
     * @param  string|null  $annee  Annee de mise encirculation du vehicule
     *
     * @return  self
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }
}

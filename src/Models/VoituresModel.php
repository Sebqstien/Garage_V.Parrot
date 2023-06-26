<?php

namespace App\Models;


class VoituresModel extends Model
{
    private int $id;
    private ?string $marque;
    private ?string $carburant;
    private float $prix;
    private string $kilometrage;
    private ?string $annee_mise_en_circulation;
    private ?string $description;
    private ImagesModel $id_image;

    public function __construct()
    {
        $this->table = "voitures";
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
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
     * Get the value of kilometrage
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * Set the value of kilometrage
     *
     * @return  self
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    /**
     * Get the value of annee_mise_en_circulation
     */
    public function getAnnee_mise_en_circulation()
    {
        return $this->annee_mise_en_circulation;
    }

    /**
     * Set the value of annee_mise_en_circulation
     *
     * @return  self
     */
    public function setAnnee_mise_en_circulation($annee_mise_en_circulation)
    {
        $this->annee_mise_en_circulation = $annee_mise_en_circulation;

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
     * Get the value of id_image
     */
    public function getId_image(ImagesModel $imageModel)
    {
        return $this->id_image = $imageModel->getId();
    }

    /**
     * Set the value of id_image
     *
     * @return  self
     */
    public function setId_image(ImagesModel $imageModel)
    {
        $this->id_image = $imageModel->getid($this->id_image);

        return $this;
    }
}

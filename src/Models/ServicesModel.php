<?php

namespace App\Models;

class ServicesModel extends Model
{
    private int $id;
    private string $titre;
    private string $description;
    private float $prix;
    private ImagesModel $id_image;

    public function __construct()
    {
        $this->table = "images";
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

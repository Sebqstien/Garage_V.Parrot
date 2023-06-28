<?php

namespace App\Models;


class AnnoncesModel extends Model
{
    private $id;
    private $titre;
    private $description;
    private $created_at;

    public function __construct()
    {
        $this->table = "annonces";
        $this->options = " INNER JOIN voitures ON annonces.id_voiture = voitures.id INNER JOIN images ON voitures.id = images.id ORDER BY created_at DESC;";
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
}

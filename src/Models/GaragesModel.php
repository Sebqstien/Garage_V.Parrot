<?php

namespace App\Models;


class GaragesModel extends Model
{
    private int $id;
    private string $nom;

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
}

<?php

namespace App\Models;


class ImagesModel extends Model
{
    private int $id_image;
    private string $path_image;
    private int $id_voiture;

    public function __construct()
    {
        $this->table = "images";
        
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id_image;
    }

    public function setId($id)
    {
        $this->id_image = $id;
        return $this;
    }


    /**
     * Get the value of path_image
     */
    public function getPath_image()
    {
        return $this->path_image;
    }

    /**
     * Set the value of path_image
     *
     * @return  self
     */
    public function setPath_image($path_image)
    {
        $this->path_image = $path_image;

        return $this;
    }

    /**
     * Get the value of id_voiture
     */
    public function getId_voiture(AnnoncesModel $annoncesModel)
    {
        return $annoncesModel->getId();
    }

    /**
     * Set the value of id_voiture
     *
     * @return  self
     */
    public function setId_voiture(AnnoncesModel $annoncesModel)
    {
        $this->id_voiture = $annoncesModel->getId();

        return $this;
    }
}

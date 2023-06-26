<?php

namespace App\Models;


class ImagesModel extends Model
{
    private int $id;
    private string $path_image;

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

    public function setId($id)
    {
        $this->id = $id;
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
}

<?php

namespace App\Models;

/**
 * Echange de Donnees avec la table Avis de la BDD
 */
class AvisModel extends Model
{
    /**
     * Cle primaire
     *
     * @var integer
     */
    private int $id;
    /**
     * Nom du client
     *
     * @var string
     */
    private string $nom;

    /**
     * Note du client
     *
     * @var integer
     */
    private int $note;

    /**
     * Commentaire du client
     *
     * @var string
     */
    private string $comentaire_avis;

    /**
     * constructeur
     */
    public function __construct()
    {
        $this->table = "avis";
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
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
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of comentaire_avis
     */
    public function getComentaire_avis()
    {
        return $this->comentaire_avis;
    }

    /**
     * Set the value of comentaire_avis
     *
     * @return  self
     */
    public function setComentaire_avis($comentaire_avis)
    {
        $this->comentaire_avis = $comentaire_avis;

        return $this;
    }
}

<?php

namespace App\Models;

/**
 * Declare les methodes concernant la table users
 * @abstract
 */
abstract class UsersModel extends Model
{
    /**
     * Cle primaire
     *
     * @var integer
     */
    private int $id;

    /**
     * Nom de l'user
     *
     * @var string|null
     */
    private ?string $nom;

    /**
     * Prenom de l'user
     *
     * @var string|null
     */
    private ?string $prenom;

    /**
     * Email de l'user.
     *
     * @var string
     */
    private string $email;

    /**
     * Roles de l'user.
     *
     * @var array
     */
    private array $roles;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "users";
    }
    //TODO: FINIR LES DOCS BLOCK


    public function findOneByEmail(string $email)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
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
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

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
     * Get the value of roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}

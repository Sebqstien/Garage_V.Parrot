<?php

namespace App\Models;

use App\Core\Database;

/**
 * Declare les methodes concernant la table users
 * @abstract
 */
class UsersModel extends Model
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
    private ?string $nom = null;

    /**
     * Prenom de l'user
     *
     * @var string|null
     */
    private ?string $prenom = null;

    /**
     * Email de l'user.
     *
     * @var string|null
     */
    private ?string $email = null;

    /**
     * Mot de passe de l'utilisateur
     *
     * @var string|null
     */
    private ?string $password = null;

    /**
     * Roles de l'utilisateur.
     *
     * @var bool|null
     */
    private ?bool $is_admin = null;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->table = "users";
    }
    //TODO: FINIR LES DOCS BLOCK

    /**
     * Recherche un utilisateur par email en BDD.
     *
     * @param string $email
     * @return array|bool
     */
    public function findOneByEmail(string $email): array|bool
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $query = Database::getInstance()->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Alimente la session avec les variables de l'utilisateur.
     *
     * @return void
     */
    public function setSession(): void
    {
        $_SESSION['user'] = [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'is_admin' => $this->is_admin
        ];
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
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get roles de l'utilisateur.
     *
     * @return  bool
     */
    public function getIs_admin()
    {
        return $this->is_admin;
    }

    /**
     * Set roles de l'utilisateur.
     *
     * @param  bool  $is_admin  Roles de l'utilisateur.
     *
     * @return  self
     */
    public function setIs_admin(bool $is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }
}

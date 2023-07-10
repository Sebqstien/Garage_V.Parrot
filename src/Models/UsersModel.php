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
     * Modifie un utilisateur existant dans la base de données.
     *
     * @param integer $id ID de l'utilisateur à modifier.
     * @param array $data Données de l'utilisateur à mettre à jour.
     * @return bool Retourne true si la modification est réussie, sinon false.
     */
    public function editUser(int $id, array $data): bool
    {
        $sql = "UPDATE {$this->table} SET nom = :nom, prenom = :prenom, email = :email, password = :password, is_admin = :is_admin WHERE id = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'id' => $id,
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => $data['is_admin'],
        ]);
        return ($query->rowCount() === 1);
    }

    /**
     * Crée un nouvel utilisateur dans la base de données.
     *
     * @param array $data Données de l'utilisateur à créer.
     * @return bool Retourne true si la création est réussie, sinon false.
     */
    public function createUser(array $data): bool
    {
        $sql = "INSERT INTO {$this->table} (nom, prenom, email, password, is_admin) VALUES (:nom, :prenom, :email, :password, :is_admin)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => $data['is_admin'],
        ]);
        return ($query->rowCount() === 1);
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

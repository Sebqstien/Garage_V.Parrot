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
}

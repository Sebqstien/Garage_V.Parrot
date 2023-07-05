<?php

namespace App\Models;

use App\Core\Database;


class AdminModel extends UsersModel
{




    /**
     * Crée un utilisateur en BDD.
     *
     * @param array $usersData Les données des utilisateurs à créer.
     * @return bool Retourne true si la création est réussie, sinon false.
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO {$this->table} (nom, prenom, email, password, is_admin) 
                VALUES (:nom, :prenom, :email, :password, :is_admin)";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => isset($data['is_admin']) ? 1 : 0,
        ]);
        return true;
    }

    /**
     * Modifie un utilisateur en BDD.
     *
     * @param integer $id de l'utiilisateur
     * @param array $data
     * @return boolean
     */
    public function edit(int $id, array $data): bool
    {
        $sql = "UPDATE {$this->table} 
                SET nom = :nom, prenom = :prenom, email = :email, 
                    password = :password, is_admin = :is_admin 
                WHERE id = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute([
            'id' => $id,
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => isset($data['is_admin']) ? 1 : 0,
        ]);
        return true;
    }

    /**
     * Supprime un utilisateur en BDD
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute(['id' => $id]);
        return true;
    }
}

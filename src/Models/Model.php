<?php

namespace App\Models;

use App\Core\Database;


/**
 * Declare les methodes d'echanges avec la base de donnees.
 * 
 * @abstract
 */
abstract class Model extends Database
{
    /**
     * nom de la table en base de donnee
     *
     * @var string
     */
    protected string $table;


    /**
     * Base de donnee
     *
     * @var Database
     */
    protected Database $database;


    public function hydrate(array $donnees): self
    {
        foreach ($donnees as $key => $value) {

            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    /**
     * Retourne tous les elements d'une table.
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = Database::getInstance()->query($sql);
        return $query->fetchAll();
    }

    /**
     * Retour un element d'une table selon son ID.
     *
     * @param integer $id
     * @return array|boolean
     */
    public function find(int $id): array|bool
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = $id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Retourne tous les elements selectionnes par ligne et cles primaire;
     *
     * @param string $row
     * @param string $primary_key
     * @param integer $id
     * @return array|boolean
     */
    public function findBy(string $row, string $foreign_key, int $id): array|bool
    {
        $sql = "SELECT $row FROM {$this->table} WHERE $foreign_key = $id";
        $query = Database::getInstance()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    /**
     * Supprime une entite en BDD
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

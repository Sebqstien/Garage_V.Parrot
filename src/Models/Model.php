<?php

namespace App\Models;

use App\Core\Database;
use PDOStatement;

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
     * Options de requete SQL
     *
     * @var string|null
     */
    protected ?string $options = null;

    /**
     * Jointure SQL
     *
     * @var string|null
     */
    protected ?string $jointure = null;

    /**
     * Base de donnee
     *
     * @var Database
     */
    protected Database $database;

    /**
     * Represente une requete SQL
     *
     * @param string $sql
     * @param array|null $attributs
     * @return PDOstatement|boolean
     */
    public function requete(string $sql, ?array $attributs = null): PDOStatement|bool
    {
        $this->database = Database::getInstance();

        if ($attributs !== null) {
            $query = $this->database->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            return $this->database->query($sql);
        }
    }

    /**
     * Retourne tous les elements d'une table.
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        $sql = "SELECT * FROM " . $this->table . $this->jointure . $this->options;
        $query = $this->requete($sql);
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
        return $this->requete($sql)->fetch();
    }

    /**
     * Retourne tous les elements slectionnes par ligne et cles primaire;
     *
     * @param string $row
     * @param string $primary_key
     * @param integer $id
     * @return array|boolean
     */
    public function findBy(string $row, string $primary_key, int $id): array|bool
    {
        $sql = "SELECT $row FROM {$this->table} WHERE $primary_key = $id";
        return $this->requete($sql)->fetchAll();
    }
}

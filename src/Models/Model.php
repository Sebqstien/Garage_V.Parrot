<?php

namespace App\Models;

use App\Core\Database;


abstract class Model extends Database
{
    protected string $table;
    protected ?string $options;
    private Database $database;


    public function requete(string $sql, ?array $attributs = null)
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

    public function findAll()
    {
        $query = $this->requete("SELECT * FROM " . $this->table . $this->options);
        return $query->fetchAll();
    }

    public function find(int $id)
    {
        $id = intval($id);
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];


        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'database' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        // On exécute la requête
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ')VALUES(' . $liste_inter . ')', $valeurs);
    }

    public function update(int $id)
    {
        $champs = [];
        $valeurs = [];


        foreach ($this as $champ => $valeur) {

            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        $liste_champs = implode(', ', $champs);

        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }


    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value) {
            $setter = 'set' . ucfirst($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
}

<?php

namespace App\Core;

use App\Config;
use PDO;
use PDOException;

/**
 * Represente une connexion avec la base de donnees.
 */
class Database extends PDO
{
    /**
     * instance PDO en singleton.
     *
     * @var PDO
     */
    private static $instance;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $_dsn = 'mysql:dbname=' . Config::DBNAME . ';host=' . Config::DBHOST;

        try {
            parent::__construct($_dsn, Config::DBUSER, Config::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Singleton instance PDO
     *
     * @return self
     */
    static protected function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

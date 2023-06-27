<?php

namespace App\Core;

use Config;
use PDO;
use PDOException;

class Database extends PDO
{
    private static $instance;


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
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

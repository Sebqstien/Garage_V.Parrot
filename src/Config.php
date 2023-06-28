<?php

namespace App;

abstract class Config
{
    /**
     *  Database host
     * @var string
     */
    public const DBHOST = 'localhost';

    /**
     *  Database user
     * @var string
     */
    public const DBUSER = 'root';

    /**
     *  Database password
     * @var string
     */
    public const DBPASS = '';

    /**
     *  Database name
     * @var string
     */
    public const DBNAME = 'garage_vparrot';
}

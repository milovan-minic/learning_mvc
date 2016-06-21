<?php

namespace Core;

use PDO;
use PDOException;
use \App\Config;

/**
 *  Base model
 *
 *  PHP Version 5.5.9
 */

/**
 * Class Model
 * @package Core
 */
abstract class Model
{
    protected static function getDB()
    {
        static $db = null;

        if($db === null) {
            $dsn =  'mysql:host=' . Config::DB_HOST .
                    ';dbname=' . Config::DB_NAME .
                    ';charset=utf8';

            $db = new PDO($dsn, Config::DB_USERNAME, Config::DB_PASSWORD);

            // Throw an exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        }
    }
}

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
//            $host = 'localhost';
//            $dbName = 'learning_mvc';
//            $username = 'root';
//            $password = 'misa';

            try{
//                $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",
//                                $username, $password);

                $dsn =  'mysql:host=' . Config::DB_HOST .
                        ';dbname=' . Config::DB_NAME .
                        ';charset=utf8';

                $db = new PDO($dsn, Config::DB_USERNAME, Config::DB_PASSWORD);

                return $db;

            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
}

<?php

namespace Core;

use PDO;
use PDOException;

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
            $host = 'localhost';
            $dbName = 'learning_mvc';
            $username = 'root';
            $password = 'misa';

            try{
                $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",
                                $username, $password);

                return $db;
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
}

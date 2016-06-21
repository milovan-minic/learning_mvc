<?php

namespace App\Models;

use \PDO;
use \PDOException;
use \Core\Model;

/**
 *  Post model
 *
 *  PHP Version 5.5.9
 */

class Post extends Model
{
    /**
     *  Get all posts in an associative array
     *
     * @return array
     */
    public static function getAll()
    {
//        $host = 'localhost';
//        $dbName = 'learning_mvc';
//        $username = 'root';
//        $password = 'misa';

        try{
//            $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",
//                $username, $password);

            $db = static::getDB();

            $statement = $db->query('  SELECT id, title, content
                                       FROM posts
                                       ORDER BY created_at');

            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

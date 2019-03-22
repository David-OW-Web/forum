<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 28.02.2019
 * Time: 11:45
 */

class DB
{
    public function openConnection($dsn, $db_user, $db_pass) {
        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
        } catch(PDOException $e) {
            die("Something in Databaseconnection is wrong: " . $e->getMessage());
        }
        return $pdo;
    }
}
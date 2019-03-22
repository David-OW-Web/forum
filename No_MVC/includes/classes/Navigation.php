<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 04.03.2019
 * Time: 11:38
 */

class Navigation
{
    private $con;
    // public $errorArray = array();
    public function __construct() {
        $pdo = new DB();
        $this->con = $pdo->openConnection(DSN, DB_USER, DB_PASS);
    }

    public function getCats() {
        $st = $this->con->prepare("SELECT * FROM category ORDER BY cat_title ASC");
        $st->execute();
        return $st->fetchAll();
    }
}
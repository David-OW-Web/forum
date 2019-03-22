<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 04.03.2019
 * Time: 12:51
 */

class CategoryPage
{
    private $con;
    // public $errorArray = array();
    public function __construct() {
        $pdo = new DB();
        $this->con = $pdo->openConnection(DSN, DB_USER, DB_PASS);
    }

    public function getCatTitleById($id) {
        $st = $this->con->prepare("SELECT cat_title FROM category WHERE cat_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->fetchAll();
    }

    public function getQuestionsByCatId($id) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE fk_cat_id = :id ORDER BY created_at DESC");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAnswersFromQuestionById($id) {
        $stmt = $this->con->prepare("SELECT * FROM answer WHERE fk_question_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
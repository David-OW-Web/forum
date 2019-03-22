<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 01.03.2019
 * Time: 12:34
 */

class Answer
{
    private $con;
    public $errorArray = array();
    public function __construct() {
        $pdo = new DB();
        $this->con = $pdo->openConnection(DSN, DB_USER, DB_PASS);
    }

    public function createAnswer($question_id, $user_id, $from, $content) {
        $st = $this->con->prepare("INSERT INTO answer (fk_question_id, fk_user_id, answer_from, answer_content) VALUES(:fk_q_id, :fk_u_id, :answer_from, :content)");
        $st->bindParam(":fk_q_id", $question_id);
        $st->bindParam(":fk_u_id", $user_id);
        $st->bindParam(":answer_from", $from);
        $st->bindParam(":content", $content);
        return $st->execute();
    }

    public function getAnswersByQuestionId($id) {
        $stmt = $this->con->prepare("SELECT * FROM answer WHERE fk_question_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if($stmt->rowCount() == 0) {
            array_push($this->errorArray, Constants::$noAnswers);
        }

        return $stmt->fetchAll();
    }

    public function getAmountOfAnswersByQuestionId($id) {
        $stmt = $this->con->prepare("SELECT * FROM answer WHERE fk_question_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function sortAnswerByNew($id) {
        $stmt = $this->con->prepare("SELECT * FROM answer WHERE fk_question_id = :id ORDER BY created_at DESC");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function sortAnswerByOld($id) {
        $stmt = $this->con->prepare("SELECT * FROM answer WHERE fk_question_id = :id ORDER BY created_at ASC");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mark answers as helpful and not helpful

    public function getError($error) {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
        return false;
    }
}
<?php

class QuestionModel {
    private $con;
    public $errorArray = array();
    // public $errorArray = array();
    public function __construct(PDO $pdo) {
        $this->con = $pdo;
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

    public function getCats() {
        $st = $this->con->prepare("SELECT * FROM category ORDER BY cat_title ASC");
        $st->execute();
        return $st->fetchAll();
    }

    public function getQuestionById($id) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE question_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function createQuestion($cat_id, $user_id, $status_id, $from, $content, $title) {
        $st = $this->con->prepare("INSERT INTO question(fk_cat_id, fk_user_id, fk_status_id, question_from, question_content, question_title) VALUES (:cat_id, :u_id, :status_id, :question_from, :content, :title)");
        $st->bindParam(":cat_id", $cat_id);
        $st->bindParam(":u_id", $user_id);
        $st->bindParam(":status_id", $status_id);
        $st->bindParam(":question_from", $from);
        $st->bindParam(":content", $content);
        $st->bindParam(":title", $title);
        return $st->execute();
    }


    public function getQuestionsByCurrentSession($session) {
        $st = $this->con->prepare("SELECT * FROM question WHERE question_from = :current_session");
        $st->bindParam(":current_session", $session);
        $st->execute();
        return $st->fetchAll();
    }

    /*
    public function getQuestionById($id) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE question_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    */

    public function getNewestQuestions() {
        $st = $this->con->prepare("SELECT * FROM question ORDER BY created_at DESC LIMIT 5");
        $st->execute();
        return $st->fetchAll();
    }

    public function SearchQuestion($queryString) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE question_title LIKE CONCAT('%', :queryString, '%') -- LIMIT :li --");
        $stmt->bindParam(":queryString", $queryString);
        // $stmt->bindParam(":li", $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*
    public function ajaxLoadMore($id) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE question_id < :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function ajaxShowMore($id, $limit) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE question_id < :id LIMIT :li");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":li", $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    */

    public function ResultsOfSearch($queryString) {
        $stmt = $this->con->prepare("SELECT * FROM question WHERE question_title LIKE CONCAT('%', :queryString, '%')");
        $stmt->bindParam(":queryString", $queryString);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function addCategory($title, $description = "") {
        $this->validateCategoryTitle($title);
        if(empty($this->errorArray)) {
            return $this->InsertCategory($title, $description);
        } else {
            return false;
        }
    }

    public function InsertCategory($title, $description = "") {
        $stmt = $this->con->prepare("INSERT INTO category (cat_title, cat_description) VALUES(:cat_title, :cat_desc)");
        $stmt->bindParam(":cat_title", $title);
        $stmt->bindParam(":cat_desc", $description);
        return $stmt->execute();
    }

    public function validateCategoryTitle($title) {
        $st = $this->con->prepare("SELECT cat_title FROM category WHERE cat_title = :title");
        $st->bindParam(":title", $title);
        $st->execute();
        if($st->rowCount() != 0) {
            array_push($this->errorArray, Constants::$categoryExists);
        }
    }

    public function deleteQuestionById($id) {
        $stmt = $this->con->prepare("DELETE FROM question WHERE question_id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteAnswersByQuestionId($id) {
        $stmt = $this->con->prepare("DELETE FROM answer WHERE fk_question_id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function paginator($limit) {
        $stmt = $this->con->prepare("SELECT * FROM question");
        $stmt->execute();
        $total = $stmt->rowCount();

//  $limit = 10;

        $pages = ceil($total / $limit);

        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));

        $offset = ($page - 1) * $limit;

        $start = $offset + 1;
        $end = min(($offset + $limit), $total);

        $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
        $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
        $link = '<div id="paging"><p>'. $prevlink . ' Page '. $page . ' of ' . $pages . ' pages, displaying '. $start . '-' . $end . ' of '. $total. ' results '. $nextlink. ' </p></div>';

        $st = $this->con->prepare("SELECT * FROM question ORDER BY created_at DESC LIMIT :limit1 OFFSET :offset1");
        $st->bindParam(":limit1", $limit, PDO::PARAM_INT);
        $st->bindParam(":offset1", $offset, PDO::PARAM_INT);
        $st->execute();
        $res = $st->fetchAll();

        return $res;
    }

    public function createPaginatorLink($limit) {
        $stmt = $this->con->prepare("SELECT * FROM question");
        $stmt->execute();
        $total = $stmt->rowCount();

//  $limit = 10;

        $pages = ceil($total / $limit);

        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));

        $offset = ($page - 1) * $limit;

        $start = $offset + 1;
        $end = min(($offset + $limit), $total);

        $prevlink = ($page > 1) ? '<a href="index?page=1" title="First page">&laquo;</a> <a href="index?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
        $nextlink = ($page < $pages) ? '<a href="index?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="index?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
        return '<div id="paging"><p>'. $prevlink . ' Seite '. $page. ' von '. $pages. ' Seiten, zeigt '. $start. '-'. $end. ' von '. $total. ' Fragen '. $nextlink. ' </p></div>';
    }

    public function getError($error) {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
        return false;
    }
}
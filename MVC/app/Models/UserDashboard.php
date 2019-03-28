<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 01.03.2019
 * Time: 08:17
 */

class UserDashboard
{
    private $con;
    public $errorArray = array();
    public function __construct(PDO $pdo) {
        $this->con = $pdo;
    }

    public function getUserDataByCurrentSession($session) {
        $stmt = $this->con->prepare("SELECT * FROM forum_user WHERE username = :current_session");
        $stmt->bindParam(":current_session", $session);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAccountStatusByStatusId($id) {
        $stmt = $this->con->prepare("SELECT * FROM account_status WHERE status_id = :fk_id");
        $stmt->bindParam(":fk_id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMenu() {
        $st = $this->con->prepare("SELECT * FROM menu");
        $st->execute();
        return $st->fetchAll();
    }

    public function getSubMenuByParentId($id) {
        $st = $this->con->prepare("SELECT * FROM submenu WHERE fk_parent_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->fetchAll();
    }

    public function createAbout($about, $id) {
        $stmt = $this->con->prepare("SELECT fk_user_id FROM about WHERE fk_user_id = :fk");
        $stmt->bindParam(":fk", $id);
        $stmt->execute();
        if($stmt->rowCount() == 1) {
            array_push($this->errorArray, Constants::$aboutAlreadyMade);
            return false;
        } else {
            $st = $this->con->prepare("INSERT INTO about (about_content, fk_user_id) VALUES(:content, :id)");
            $st->bindParam(":content", $about);
            $st->bindParam(":id", $id);
            return $st->execute();
        }
    }

    public function getOnlineUsers() {
        $st = $this->con->prepare("SELECT * FROM login WHERE fk_online_status_id = 1");
        $st->execute();
        return $st->rowCount();
    }

    public function getError($error) {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
        return false;
    }
}
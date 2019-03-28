<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 28.02.2019
 * Time: 11:48
 */



class Account
{
    private $con;
    public $errorArray = array();
    public function __construct(PDO $pdo) {
        $this->con = $pdo;
    }

    /**
     * Returns the execution of the query for Registration
     * @param $email, $username, $password, $profile_pic, $status
     */

    public function Register($email, $username, $password,  $profile_pic, $status) {
        $this->validateEmail($email);
        $this->validateUsername($username);
        $this->validatePassword($password);
        $this->validateProfilePic($profile_pic);

        if(empty($this->errorArray)) {
            return $this->InsertUserDetails($email, $username, $password, $profile_pic, $status);
        } else {
            return false;
        }
    }


    /**
     * Updates the password. Validates the old password and the new password
     * @param $oldPw, $newPw, $user_id
     */
    public function updatePassword($oldPw, $newPw, $user_id) {
        $this->validatePassword($newPw);
        $this->validateOldPassword($oldPw, $user_id);

        if(empty($this->errorArray)) {
            $newPw = hash("sha512", $newPw);
            $stmt = $this->con->prepare("UPDATE forum_user SET user_password = :newPw WHERE user_id = :id");
            $stmt->bindParam(":newPw", $newPw);
            $stmt->bindParam(":id", $user_id);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Returns validation of old password
     * @return void
     * @param $pw, $user_id
     */
    public function validateOldPassword($pw, $user_id) {
        $pw = hash("sha512", $pw);
        $stmt = $this->con->prepare("SELECT * FROM forum_user WHERE user_id = :id AND user_password = :pw");
        $stmt->bindParam(":id", $user_id);
        $stmt->bindParam(":pw", $pw);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            array_push($this->errorArray, Constants::$passwordIncorrect);
        }
    }

    public function sendConfirmationMail($emailTo, $username, $from = "david_blitz@protonmail.ch") {
        $subject = "Registrierung";
        $message = "Ihr account mit der Email " . $emailTo . "und dem Username " . $username . "wurde erfolgreich erstellt";
        $fromEmail = "From: " . $from;
    }

    public function InsertUserDetails($email, $username, $password, $profile_pic, $status) {
        $password = hash("sha512", $password);
        $stmt = $this->con->prepare("INSERT INTO forum_user (email, username, user_password, profile_pic, fk_account_status_id) VALUES(:email, :un, :pw, :pic, :fk_status_id)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":un", $username);
        $stmt->bindParam(":pw", $password);
        $stmt->bindParam(":pic", $profile_pic);
        $stmt->bindParam(":fk_status_id", $status);
        $stmt->rowCount();
        return $stmt->execute();
    }

    public function Login($email, $password) {
        $password = hash("sha512", $password);
        $stmt = $this->con->prepare("SELECT * FROM forum_user WHERE email = :email AND user_password = :pw");
        //   OR username = :un
        // $stmt->bindParam(":un", $email);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pw", $password);
        $stmt->execute();


        $st = $this->con->prepare("SELECT email FROM forum_user WHERE email = :email");
        $st->bindParam(":email", $email);
        $st->execute();
        if($st->rowCount() == 0) {
            array_push($this->errorArray, Constants::$emailDoesNotExist);
        }

        $query = $this->con->prepare("SELECT fk_account_status_id FROM forum_user WHERE email = :email AND user_password = :pw");
        $query->bindParam(":email", $email);
        $query->bindParam(":pw", $password);
        $query->execute();
        $results = $query->fetchAll();
        foreach($results as $res) {
            if($res['fk_account_status_id'] == 2) {
                array_push($this->errorArray, Constants::$accountClosed);
                return false;
            }
        }

        if($stmt->rowCount() == 1) {
            $data = $stmt->fetchAll();
            foreach($data as $d) {
                $_SESSION['forum_user'] = $d['username'];
                return true;
            }
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }

    public function validateEmail($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$invalidEmail);
        }

        if(strlen($email) > 100) {
            array_push($this->errorArray, Constants::$emailTooLong);
        }

        $stmt = $this->con->prepare("SELECT email FROM forum_user WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    public function validateUsername($username) {
        if(strlen($username) > 30) {
            array_push($this->errorArray, Constants::$usernameTooLong);
        }

        $stmt = $this->con->prepare("SELECT username FROM forum_user WHERE username = :un");
        $stmt->bindParam(":un", $username);
        $stmt->execute();
        if($stmt->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    public function validatePassword($password) {
        if(strlen($password) > 30 || strlen($password) < 5) {
            array_push($this->errorArray, Constants::$passwordTooLong);
        }
    }

    public function validateProfilePic($pic) {
        if(strlen($pic) > 50) {
            array_push($this->errorArray, Constants::$fileNameTooLong);
        }
    }

    public function getAmountOfAnswersByUserId($id) {
        $st = $this->con->prepare("SELECT * FROM answer WHERE fk_user_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->rowCount();
    }

    public function getAmountOfQuestionsByUserId($id) {
        $st = $this->con->prepare("SELECT * FROM question WHERE fk_user_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->rowCount();
    }

    public function getAboutByUserId($id) {
        $st = $this->con->prepare("SELECT * FROM about WHERE fk_user_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->fetchAll();
    }

    public function getQuestionsByUserId($id) {
        $st = $this->con->prepare("SELECT * FROM question WHERE fk_user_id = :fk_user_id");
        $st->bindParam(":fk_user_id", $id);
        $st->execute();
        if($st->rowCount() == 0) {
            array_push($this->errorArray, Constants::$userNoQuestions);
        }
        return $st->fetchAll();
    }

    public function getAnswersByUserId($id) {
        $st = $this->con->prepare("SELECT * FROM answer WHERE fk_user_id = :fk_user_id");
        $st->bindParam(":fk_user_id", $id);
        $st->execute();
        if($st->rowCount() == 0) {
            array_push($this->errorArray, Constants::$userNoAnswers);
        }
        return $st->fetchAll();
    }

    public function getUserById($id) {
        $st = $this->con->prepare("SELECT * FROM forum_user WHERE user_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->fetchAll();
    }

    public function getUsernameById($id) {
        $st = $this->con->prepare("SELECT username FROM forum_user WHERE user_id = :id");
        $st->bindParam(":id", $id);
        $st->execute();
        return $st->fetchAll();
    }

    public function logoutUserAfterInactivity() {
        if(isset($_SESSION['forum_user'])) {
            if(time() - $_SESSION['last_login'] > 900) {
                $_SESSION['inactivity_message'] = "Sie wurden wegen Inaktivität ausgeloggt";
                unset($_SESSION['forum_user']);
                header("Location: ../login.php");
            }
        }
    }

    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function InsertLoginActivity($fk_user_id, $public_ip) {
        $st = $this->con->prepare("INSERT INTO login (fk_user_id, ip_address, user_agent, fk_status_id) VALUES(:u_id, :ip, :ua, 1)");
        // Fk online status id = 1
        $st->bindParam(":ua", $_SERVER['HTTP_USER_AGENT']);
        $st->bindParam(":u_id", $fk_user_id);
        $st->bindParam(":ip", $public_ip);
        return $st->execute();
    }

    public function updateLogoutDate($id) {
        $st = $this->con->prepare("UPDATE login SET logout_date = CURRENT_TIMESTAMP() WHERE fk_user_id = :id ORDER BY login_date DESC LIMIT 1");
        // UPDATE login SET logout_date = CURRENT_TIMESTAMP(), fk_online_status_id = 2 WHERE fk_user_id = :id ORDER BY login_date DESC LIMIT 1
        $st->bindParam(":id", $id);
        return $st->execute();
    }

    public function getLoginActivityByUserId($id) {
        $stmt = $this->con->prepare("SELECT * FROM login WHERE fk_user_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteLoginActivityByLoginId($id) {
        $stmt = $this->con->prepare("DELETE FROM login WHERE login_id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function updateLoginStatusById($id) {
        $stmt = $this->con->prepare("UPDATE login SET fk_status_id = 2 WHERE login_id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function cleanUncleanAccount() {
        $stmt = $this->con->prepare("UPDATE login SET logout_date = CURRENT_TIMESTAMP(), fk_online_status_id = 2 WHERE login_date = logout_date");
    }

    public function accountDangerMessage($user_id) {
        $stmt = $this->con->prepare("SELECT fk_status_id FROM login WHERE fk_user_id = :u_id AND fk_status_id = 2");
        $stmt->bindParam(":u_id", $user_id);
        $stmt->execute();
        if($stmt->rowCount() != 0) {
            array_push($this->errorArray, Constants::$accountInDanger);
        }
    }

    public function getUserIdByCurrentSession($session) {
        $st = $this->con->prepare("SELECT user_id FROM forum_user WHERE username = :current_session");
        $st->bindParam(":current_session", $session);
        $st->execute();
        $res = $st->fetchAll();
        foreach($res as $r) {
            return $r['user_id'];
        }
    }

    public function getError($error) {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
        return false;
    }
}
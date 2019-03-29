<?php

class Account {
  private $con;
  public $errorArray = array();
  public function __construct(PDO $pdo) {
    $this->con = $pdo;
  }

  // Registration

  public function Register($email, $username, $password, $password2, $profile_pic) {
    $this->validateEmail($email);
    $this->validateUsername($username);
    $this->validatePasswords($password, $password2);
    $this->validateProfilePic($profile_pic);

    if(empty($this->errorArray)) {
      return $this->InsertUserDetails($email, $username, $password, $profile_pic);
    } else {
      return false;
    }
  }

  public function InsertUserDetails($email, $username, $password, $profile_pic) {
    $password = hash("sha512", $password);
    $stmt = $this->con->prepare("INSERT INTO forum_user (email, username, user_password, profile_pic, fk_account_status_id) VALUES(:em, :un, :pw, :pic, 2)");
    $stmt->bindParam(":em", $email);
    $stmt->bindParam(":un", $username);
    $stmt->bindParam(":pw", $password);
    $stmt->bindParam(":pic", $profile_pic);
    return $stmt->execute();
  }

  public function InsertVerifyDetails($email, $user_id, $token) {
    $stmt = $this->con->prepare("INSERT INTO email_verification (email, fk_user_id, token) VALUES(:em, :id, :token)");
    $stmt->bindParam(":em", $email);
    $stmt->bindParam(":id", $user_id);
    $stmt->bindParam(":token", $token);
    return $stmt->execute();
  }

  public function generateToken() {
    $token = "qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM!$/()*";
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);
    return $token;
  }

  public function sendVerifyEmail($email, $token) {
    // $token = $this->generateToken();
    $subject = "E-Mail Verifikation";
    $message = "Bitte verifizieren Sie ihre E-Mail. Klicken Sie auf den Link \n" . "<a href='https://windproof-wall.000webhostapp.com/confirm?email=$email&token=$token'>Verifizieren</a>";
    $from = "From: david.discordserver@gmail.com";
    return mail($email, $subject, $message, $from);
  }

  public function verifyEmail($email, $token) {
    $stmt = $this->con->prepare("SELECT fk_user_id FROM email_verification WHERE token = :token AND email = :email");
    $stmt->bindParam(":token", $token);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $st = $this->con->prepare("UPDATE email_verification SET token = '' WHERE email = :em");
      $st->bindParam(":em", $email);
      return $st->execute();      
    }
  }

  public function setStatusToVerified($email) {
    $stmt = $this->con->prepare("SELECT fk_user_id FROM email_verification WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      // $result = $stmt->fetch();
      // $user_id = $result['fk_user_id'];
      $st = $this->con->prepare("UPDATE forum_user SET fk_account_status_id = 1 WHERE email = :em");
      $st->bindParam(":em", $email);
      return $st->execute();      
    }
  }

  // User-ID

  public function getUserIdByEmail($email) {
    $stmt = $this->con->prepare("SELECT user_id FROM forum_user WHERE email = :em");
    $stmt->bindParam(":em", $email);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['user_id'];
  }

  // Login

  // Validation

  public function validateEmail($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($this->errorArray, Constants::$invalidEmail);
    }

    if(strlen($email) > 100) {
      array_push($this->errorArray, Constants::$emailTooLong);
    }

    $stmt = $this->con->prepare("SELECT email FROM forum_user WHERE email = :em");
    $stmt->bindParam(":em", $email);
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

  public function validatePasswords($password, $password2) {
    if($password != $password2) {
      array_push($this->errorArray, Constants::$passwordsDoNotMatch);
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
      array_push($this->errorArray, Constants::$passwordLength);
    }
  }

  public function validateProfilePic($profile_pic) {
    if(strlen($profile_pic) > 50) {
      array_push($this->errorArray, Constants::$fileNameTooLong);
    }
  }

  public function getError($error) {
    if(in_array($error, $this->errorArray)) {
      return $error;
    }
    return false;
  }
}

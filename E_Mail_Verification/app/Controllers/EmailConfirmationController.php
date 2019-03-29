<?php

require 'app/Models/Account.php';

$verifyObject = new Account($pdo);

if(!isset($_GET['email']) || !isset($_GET['token'])) {
    header("Location: register");
} else {
    $email = $_GET['email'];
    $token = $_GET['token'];
    $verifyEmail = $verifyObject->verifyEmail($email, $token);
    if($verifyEmail) {
        $setStatusToVerified = $verifyObject->setStatusToVerified($email);
        if($setStatusToVerified) {
            $msg = "Ihre Email " . $email . " wurde verifiziert";
        }
    }
}

require 'app/Views/confirm_email.view.php';
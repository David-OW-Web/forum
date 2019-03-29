<?php

require 'app/Models/Account.php';

$registerObj = new Account($pdo);

if(isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $pic = $_FILES['profile_pic']['name'];
    $pic_tmp = $_FILES['profile_pic']['tmp_name'];
    move_uploaded_file($pic_tmp, "images/profile_pic/$pic");

    $register = $registerObj->Register($email, $username, $password, $password2, $pic);

    if($register) {
        $user_id = $registerObj->getUserIdByEmail($email);
        $token = $registerObj->generateToken();
        $insert_verify = $registerObj->InsertVerifyDetails($email, $user_id, $token);
        $send_verify = $registerObj->sendVerifyEmail($email, $token);
        if($insert_verify && $send_verify) {
            $msg = "Ein Verifikationslink wurde an Ihre Email gesendet. Bitte verifizieren";
        }
    }
}

require 'app/Views/register.view.php';

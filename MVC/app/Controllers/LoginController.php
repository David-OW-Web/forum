<?php
require 'app/Models/Question.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';
// yield
require 'app/Models/Account.php';
require 'app/Models/Constants.php';
$loginObj = new Account($pdo);
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = $loginObj->Login($email, $password);
    if($login) {
        $user_id = $loginObj->getUserIdByCurrentSession($_SESSION['forum_user']);
        $session_id = session_id();
        $public_ip = $loginObj->getRealIpAddr();
        $insertData = $loginObj->InsertLoginActivity($user_id, $public_ip);
        header("Location: user/dashboard");
    }
}

require 'app/Views/login.view.php';
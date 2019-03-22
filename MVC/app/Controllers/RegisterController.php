<?php
require 'app/Models/Question.php';
require 'app/Models/Account.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';
$registerObj = new Account($pdo);
if(isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pic = $_FILES['profile_pic']['name'];
    $pic_tmp = $_FILES['profile_pic']['tmp_name'];
    move_uploaded_file($pic_tmp, "images/profile_pic/$pic");
    $status = 1;

    $register = $registerObj->Register($email, $username, $password, $pic, $status);

    if ($register) {
        $_SESSION['forum_user'] = $username;
        header("Location: login");
    }
}
require 'app/Views/register.view.php';
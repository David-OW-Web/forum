<?php

require 'app/Models/Account.php';
require 'app/Models/Question.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);

$accObj = new Account($pdo);
// $logoutAfterInactivity = $accObj->logoutUserAfterInactivity();

$questionObj = new QuestionModel($pdo);

$getId = $accObj->getUserIdByCurrentSession($_SESSION['forum_user']);

$cats = $questionObj->getCats();

if(isset($_POST['create_question'])) {
    $title = $_POST['title'];
    $question = $_POST['question'];
    $cat_id = $_POST['cat_id'];
    $user_id = $getId;
    $status_id = 1;
    $from = $_SESSION['forum_user'];

    $createQuestion = $questionObj->createQuestion($cat_id, $user_id, $status_id, $from, $question, $title);
}

require 'app/Views/create_question.view.php';
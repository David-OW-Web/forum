<?php
require 'app/Models/Question.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';
$n_questions = $questionObj->getNewestQuestions();
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $pagination = $questionObj->paginator(5);
} else {
    header("Location: index?page=1");
}
$link = $questionObj->createPaginatorLink(5); 
require 'app/Views/index.view.php';
// Nur zum Testen ob Controller funktioniert print_r($_GET);
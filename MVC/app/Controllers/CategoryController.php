<?php
require 'app/Models/Question.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $cats = $questionObj->getCatTitleById($id);
    $questions = $questionObj->getQuestionsByCatId($id);
    // $pdo = null;
} else {
    header("Location: category?id=1");
}

require 'app/Views/category.view.php';
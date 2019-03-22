<?php
require 'app/Models/Question.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
if(isset($_POST['add_category'])) {
    $cat_title = $_POST['title'];
    $cat_desc = $_POST['description'];
    $addCategory = $questionObj->addCategory($cat_title, $cat_desc);
}
require 'app/Views/add_category.view.php';
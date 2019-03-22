<?php
require 'app/Models/Question.php';
require 'app/Models/Account.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';
$accountObj = new Account($pdo);
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $numA = $accountObj->getAmountOfAnswersByUserId($id);
    $numQ = $accountObj->getAmountOfQuestionsByUserId($id);
    $infos = $accountObj->getAboutByUserId($id);
    $questions = $accountObj->getQuestionsByUserId($id);
    $answers = $accountObj->getAnswersByUserId($id);
    $user_infos = $accountObj->getUserById($id);
}
require 'app/Views/account.view.php';
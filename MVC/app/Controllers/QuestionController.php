<?php
require 'app/Models/Question.php';
require 'app/Models/Account.php';
require 'app/Models/Answer.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$answerObj = new AnswerModel($pdo);
$accountObj = new Account($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1;
}
$questions = $questionObj->getQuestionById($id);
$answers = $answerObj->getAnswersByQuestionId($id);
$numAnswers = $answerObj->getAmountOfAnswersByQuestionId($id);
if(isset($_POST['sort1'])) {
    $sort = $_POST['sort'];
    if($sort == 1) {
        $answers = $answerObj->sortAnswerByNew($id);
    } elseif($sort == 2) {
        $answers = $answerObj->sortAnswerByOld($id);
    }
}

$user_id = $accountObj->getUserIdByCurrentSession(@$_SESSION['forum_user']);

if(isset($_POST['answer_question'])) {
    if(isset($_SESSION['forum_user'])) {
        $answer = $_POST['answer'];

        $answer_question = $answerObj->createAnswer($id, $user_id, $_SESSION['forum_user'], $answer);

        header("Location: question?id=$id");
    } else {
        header("Location: login");
    }
}

require 'app/Views/question.view.php';
// print_r($_POST);
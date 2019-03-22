<?php
require 'app/Models/Question.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$questions = $questionObj->getQuestionsByCurrentSession($_SESSION['forum_user']);
if(isset($_GET['delete_id'])) {
    $question_id = $_GET['delete_id'];
    $deleteAnswers = $questionObj->deleteAnswersByQuestionId($question_id);
    $deleteQuestion = $questionObj->deleteQuestionById($question_id);
    header("Location: my_questions");
}
require 'app/Views/my_questions.view.php';
<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 01.03.2019
 * Time: 11:14
 */

require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Question.php';
require 'includes/classes/Answer.php';
require 'includes/classes/Constants.php';
require 'includes/classes/Navigation.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1;
}



$questionObj = new Question();
$answerObj = new Answer();
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

$user_id = $questionObj->getUserIdByCurrentSession(@$_SESSION['forum_user']);



if(isset($_POST['answer_question'])) {
    if(isset($_SESSION['forum_user'])) {
        $answer = $_POST['answer'];

        $answer_question = $answerObj->createAnswer($id, $user_id, $_SESSION['forum_user'], $answer);

        header("Location: question.php?id=$id");
    } else {
        header("Location: login.php");
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="../Forum">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <?php require 'includes/navbar.php'; ?>
    <div class="question-container">
    <?php foreach ($questions as $question): ?>
        <strong><?php echo $question['question_title']; ?></strong>
        <p>Frage erstellt am: <?php echo $question['created_at']; ?></p>
    <p>Frage gestellt von: <a href="account.php?id=<?php echo $question['fk_user_id']; ?>"><?php echo $question['question_from']; ?></a></p>
        <!-- Status der Frage -->
        <p><?php echo $question['question_content']; ?></p>
    <?php endforeach; ?>
    </div>

    <!-- Antworten -->

    <?php echo $answerObj->getError(Constants::$noAnswers); ?>

    <div class="question-options">
        <p><?php echo $numAnswers; ?> Antworten</p>
        <form action="" method="post">
            <label for="sort">Antworten sortieren</label>
            <select name="sort" id="sort">
                <option value="">Sortieren nach</option>

                <option value="1">Neueste Antworten</option>
                <option value="2">Älteste Antworten</option>
            </select>

            <button type="submit" name="sort1">Sortieren</button>
        </form>
    </div>
    <!-- Funktion als Hilfreich markieren hinzufügen -->
    <div class="container">
    <?php foreach($answers as $answer): ?>
    <div class="answer-container">
    <p>Antwort von: <a href="account.php?id=<?php echo $answer['fk_user_id']; ?>"><?php echo $answer['answer_from']; ?></a></p>
    <p>Antwort am <?php echo $answer['created_at'] ?></p>
    <p><?php echo $answer['answer_content']; ?></p>
    </div>
    <?php endforeach; ?>
    </div>

    <!-- Ähnliche Fragen -->

    <!-- Antworten schreiben -->

    <form action="" method="post">
        <label for="answer">Antwort</label>
        <textarea name="answer" id="answer" cols="30" rows="10"></textarea>

        <button type="submit" name="answer_question">Antworten</button>
    </form>
</div>
</body>
</html>

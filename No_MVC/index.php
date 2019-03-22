<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 28.02.2019
 * Time: 10:36
 */

require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Navigation.php';
require 'includes/classes/Question.php';
require 'includes/classes/CategoryPage.php';

$questionObj = new Question();
$catObj = new CategoryPage();
$n_questions = $questionObj->getNewestQuestions();

if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $pagination = $questionObj->paginator(10);
} else {
    header("Location: index/1");
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

    <h1 class="title">Neueste Fragen</h1>
    <div class="grid-container">
    <div class="newest-questions">
        <?php foreach($n_questions as $n_question): ?>
        <div class="question-card">
            <p>Frage von <a href="account.php?id=<?php echo $n_question['fk_user_id']; ?>"><?php echo $n_question['question_from']; ?></a></p>
            <p><?php echo $n_question['created_at']; ?></p>
            <p><?php echo $n_question['question_title']; ?></p>
            <a href="question.php?id=<?php echo $n_question['question_id']; ?>">Zur Frage</a>
            <?php $answers = $catObj->getAnswersFromQuestionById($n_question['question_id']); ?>
            <p><?php echo $answers; ?> Antworten</p>
        </div>
        <?php endforeach; ?>
    </div>
    </div>

    <div class="search-bar">
        <form action="search.php" method="get">
            <label for="keyword">Suchbegriff</label>
            <input type="text" id="keyword" name="q" placeholder="Suche eingeben">
            <button type="submit">Suchen</button>
        </form>
    </div>

    <!-- Container for Pagination -->
    <div class="grid-container">
        <?php if(is_array($pagination)): ?> <!-- @$pagination weil es sonst Notice ausgibt -->
        <?php foreach($pagination as $pag): ?>
        <div class="question-card">
            <p>Frage von <a href="account.php?id=<?php echo $pag['fk_user_id']; ?>"><?php echo $pag['question_from']; ?></a></p>
            <p><?php echo $pag['created_at']; ?></p>
            <p><?php echo $pag['question_title']; ?></p>
            <a href="question/<?php echo $pag['question_id']; ?>">Zur Frage</a>
            <?php $answers = $catObj->getAnswersFromQuestionById($pag['question_id']); ?>
            <p><?php echo $answers; ?> Antworten</p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php $link = $questionObj->createPaginatorLink(10); echo $link; ?>
</div>
<script src="js/dropdown.js"></script>
</body>
</html>

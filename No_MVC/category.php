<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 04.03.2019
 * Time: 12:50
 */

require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Navigation.php';
require 'includes/classes/CategoryPage.php';

$catObj = new CategoryPage();
$navObj = new Navigation();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $questions = $catObj->getQuestionsByCatId($id);
    $cats = $catObj->getCatTitleById($id);
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
    <?php foreach($cats as $cat): ?>
    <title><?php echo $cat['cat_title']; ?></title>
    <?php endforeach; ?>
</head>
<body>
<div class="wrapper">
    <?php require 'includes/navbar.php'; ?>

    <?php $catss = $catObj->getCatTitleById($_GET['id']); foreach($catss as $cat): ?>
    <h1 class="title">Fragen von Kategorie: <?php echo $cat['cat_title']; ?></h1>
    <?php endforeach; ?>
    <div class="grid-container">
    <?php foreach($questions as $question): ?>
    <div class="question-card">
        <p>Frage von <a href="account.php?id=<?php echo $question['fk_user_id']; ?>"><?php echo $question['question_from']; ?></a></p>
        <p><?php echo $question['created_at']; ?></p>
        <p><?php echo $question['question_title']; ?></p>
        <a href="question.php?id=<?php echo $question['question_id']; ?>">Zur Frage</a>
        <?php $answers = $catObj->getAnswersFromQuestionById($question['question_id']); ?>
        <p><?php echo $answers; ?> Antworten</p>
    </div>
    <?php endforeach; ?>
    </div>
</div>
</body>
</html>

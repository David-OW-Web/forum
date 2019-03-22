<?php
require '../includes/config.php';
require '../includes/DB.php';
require '../includes/classes/UserDashboard.php';
require '../includes/classes/Question.php';
require '../includes/classes/Account.php';

$accObj = new Account();
// $logoutAfterInactivity = $accObj->logoutUserAfterInactivity();

$questionObj = new Question();

$getId = $questionObj->getUserIdByCurrentSession($_SESSION['forum_user']);

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

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <?php require 'includes/sidebar.php'; ?>

    <div class="container">
        <form action="" method="post">
            <label for="title">Titel (Kurzbeschreibung)</label>
            <input type="text" id="title" name="title">

            <label for="question">Frage</label>
            <textarea name="question" id="question" cols="30" rows="10"></textarea>

            <label for="category">Kategorie</label>
            <select name="cat_id" id="category">
                <option value="">Wähle eine Kategorie</option>
                <?php foreach($cats as $cat): ?>
                    <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="create_question">Frage stellen</button>
        </form>
    </div>
</div>
<script src="js/sidebar_dropdown.js"></script>
</body>
</html>

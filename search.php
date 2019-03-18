<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 04.03.2019
 * Time: 14:00
 */

require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Navigation.php';
require 'includes/classes/Question.php';
require 'includes/classes/CategoryPage.php';

$searchObj = new Question();

if(isset($_GET['q'])) {
    $q = $_GET['q'];
    $results = $searchObj->SearchQuestion($q);
    $numResults = $searchObj->ResultsOfSearch($q);
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
    <title><?php echo @$_GET['q']; ?></title>
</head>
<body>
<div class="wrapper">
    <?php require 'includes/navbar.php'; ?>

    <div class="search-bar-left">
        <form action="search.php" method="get">
            <label for="keyword">Suchbegriff</label>
            <input type="text" id="keyword" name="q" placeholder="Suche eingeben">
            <button type="submit">Suchen</button>
        </form>
    </div>

    <div class="search-results">
        <p><?php echo $numResults; ?> Resultate für Ihre Suche</p>
        <?php foreach($results as $result): ?>
        <div class="result-container">
            <p>Frage von <a href="account.php?id=<?php echo $result['fk_user_id']; ?>"><?php echo $result['question_from']; ?></a></p>
            <a href="question.php?id=<?php echo $result['question_id']; ?>"><?php echo $result['question_title']; ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

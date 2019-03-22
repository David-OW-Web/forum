<?php

require 'app/Models/Question.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$questionObj = new QuestionModel($pdo);
$navlinks = $questionObj->getCats();
require 'app/Views/navbar.view.php';

if(isset($_GET['q'])) {
    $q = $_GET['q'];
    $results = $questionObj->SearchQuestion($q);
    $numResults = $questionObj->ResultsOfSearch($q);
}

require 'app/Views/search.view.php';
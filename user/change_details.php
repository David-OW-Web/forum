<?php
require '../includes/config.php';
require '../includes/DB.php';
require '../includes/classes/UserDashboard.php';
require '../includes/classes/Question.php';
require '../includes/classes/Constants.php';
require '../includes/classes/Account.php';

$accObj = new Account();
// $logoutAfterInactivity = $accObj->logoutUserAfterInactivity();

$questionObj = new Question();
$accountObj = new UserDashboard();
$user_id = $questionObj->getUserIdByCurrentSession($_SESSION['forum_user']);

if(isset($_POST['about_me'])) {
    $about = $_POST['about'];
    $create_about = $accountObj->createAbout($about, $user_id);
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
    <!-- Email wechseln (nur möglich mit Passwort | Username wechseln | Passwort wechseln -->

<div class="wrap">
    <form action="" method="post">
    <label for="about">Über mich</label>
        <?php echo $accountObj->getError(Constants::$aboutAlreadyMade); ?>
    <input type="text" id="about" name="about">

    <button type="submit" name="about_me">About</button>
    </form>
</div>
</div>
<script src="js/sidebar_dropdown.js"></script>
</body>
</html>

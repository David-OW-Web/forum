<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 15.03.2019
 * Time: 09:40
 */

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

$logins = $accObj->getLoginActivityByUserId($user_id);

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
    <?php foreach($logins as $login): ?>
    <div class="login-activity">
    <p>Login-Datum: <?php echo $login['login_date']; ?></p>
    <p>Browser: <?php echo $login['user_agent']; ?></p>
    <p>IP-Adresse: <?php echo $login['ip_address']; ?></p>
        <div class="button-group" style="color: black;">
            <a href="login_activity.php?delete_id=<?php echo $login['login_id']; ?>">Ja, das war ich</a>
            <a href="login_activity.php?update_status_id=<?php echo $login['fk_status_id']; ?>">Unbekannt</a>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
</div>
<script src="js/sidebar_dropdown.js"></script>
</body>
</html>

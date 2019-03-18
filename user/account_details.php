<?php
require '../includes/config.php';
require '../includes/DB.php';
require '../includes/classes/UserDashboard.php';
require '../includes/classes/Account.php';

$accObj = new Account();
$logoutAfterInactivity = // $accObj->logoutUserAfterInactivity();


$dashboardObj = new UserDashboard();
$infos = $dashboardObj->getUserDataByCurrentSession($_SESSION['forum_user']);
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
    <?php if (isset($_SESSION['forum_user'])): ?>
        <?php foreach ($infos as $info): ?>
        <div class="container">
            <p>Mitglied seit: <?php echo $info['created_at']; ?></p>
            <p><?php echo $info['email']; ?></p>
            <p><?php echo $info['username']; ?></p>
            <?php if ($info['profile_pic'] == ""): ?>
                <p>Kein Profilbild vorhanden!</p>
            <?php else: ?>
                <img src="../images/profile_pic/<?php echo $info['profile_pic']; ?>" alt="">
            <?php endif; ?>
            <?php $getStatus = $dashboardObj->getAccountStatusByStatusId($info['fk_account_status_id']); ?>
            <?php foreach ($getStatus as $status): ?>
                <p>Accountstatus: <?php echo $status['description']; ?></p>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?> <!-- Anzeigen wie viele Fragen der User schon gestellt hat und vielleicht noch Antworten -->

<?php else: ?>

    <?php header("Location: login.php"); ?>

<?php endif; ?>
</div>
<script src="js/sidebar_dropdown.js"></script>
</body>
</html>
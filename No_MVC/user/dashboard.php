<?php
require '../includes/config.php';
require '../includes/DB.php';
require '../includes/classes/UserDashboard.php';
require '../includes/classes/Account.php';

$accObj = new Account();

// $logoutAfterInactivity = $accObj->logoutUserAfterInactivity();



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

    <p>ä</p>
</div>
<script src="js/sidebar_dropdown.js"></script>
</body>
</html>

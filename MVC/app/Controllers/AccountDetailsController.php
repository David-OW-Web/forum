<?php
require 'app/Models/UserDashboard.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$dashboardObj = new UserDashboard($pdo);
$infos = $dashboardObj->getUserDataByCurrentSession($_SESSION['forum_user']);
require 'app/Views/account_details.view.php';
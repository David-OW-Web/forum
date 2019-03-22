<?php

require 'app/Models/UserDashboard.php';
require 'app/Models/Account.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$accountObj = new UserDashboard($pdo);
$accObj = new Account($pdo);
$user_id = $accObj->getUserIdByCurrentSession($_SESSION['forum_user']);

if(isset($_POST['about_me'])) {
    $about = $_POST['about'];
    $create_about = $accountObj->createAbout($about, $user_id);
}

require 'app/Views/change_details.view.php';
<?php
require 'app/Models/Account.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);
$accObj = new Account($pdo);
$user_id = $accObj->getUserIdByCurrentSession($_SESSION['forum_user']);
$updateLogoutDate = $accObj->updateLogoutDate($user_id);
unset($_SESSION['forum_user']);
header("Location: login");
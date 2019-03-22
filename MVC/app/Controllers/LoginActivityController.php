<?php
require 'app/Models/Account.php';
require 'app/Models/Constants.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);

$accObj = new Account($pdo);
// $logoutAfterInactivity = $accObj->logoutUserAfterInactivity();

// $questionObj = new Question();
// $accountObj = new UserDashboard();
$user_id = $accObj->getUserIdByCurrentSession($_SESSION['forum_user']);

$logins = $accObj->getLoginActivityByUserId($user_id);

if(isset($_GET['delete_id'])) {
    $login_id = $_GET['delete_id'];
    $deleteActivity = $accObj->deleteLoginActivityByLoginId($login_id);
    header("Location: login_activity");
}

if(isset($_GET['update_status_id'])) {
    $login_id = $_GET['update_status_id'];
    $updateActivity = $accObj->updateLoginStatusById($login_id);
    header("Location: login_activity");
}

$getDangerStatus = $accObj->accountDangerMessage($user_id);

require 'app/Views/login_activity.view.php';
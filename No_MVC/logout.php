<?php
session_start();
require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Account.php';
require 'includes/classes/Question.php';
$accObj = new Account();
$questionObj = new Question();
$user_id = $questionObj->getUserIdByCurrentSession($_SESSION['forum_user']);
$updateLogoutDate = $accObj->updateLogoutDate($user_id);
session_destroy();
header("Location: login.php");
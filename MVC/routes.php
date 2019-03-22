<?php

$router = new Router();

$router->define([
    "" => "app/Controllers/IndexController.php",
    "index" => "app/Controllers/IndexController.php",
    "question" => "app/Controllers/QuestionController.php",
    "category" => "app/Controllers/CategoryController.php",
    "login" => "app/Controllers/LoginController.php",
    "register" => "app/Controllers/RegisterController.php",
    "logout" => "app/Controllers/LogoutController.php",
    "search" => "app/Controllers/SearchController.php",
    "account" => "app/Controllers/AccountController.php",
    "user/dashboard" => "app/Controllers/DashboardController.php",
    "user/account_details" => "app/Controllers/AccountDetailsController.php",
    "user/change_details" => "app/Controllers/ChangeDetailsController.php",
    "user/create_question" => "app/Controllers/CreateQuestionController.php",
    "user/my_questions" => "app/Controllers/MyQuestionsController.php",
    "user/login_activity" => "app/Controllers/LoginActivityController.php",
    "user/add_category" => "app/Controllers/AddCategoryController.php"
]);
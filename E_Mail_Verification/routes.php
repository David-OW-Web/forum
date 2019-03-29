<?php

$router = new Router();

$router->define([
  "" => "app/Controllers/IndexController.php",
  "index" => "app/Controllers/IndexController.php",
  "register" => "app/Controllers/RegisterController.php",
  "login" => "app/Controllers/LoginController.php",
  "confirm" => "app/Controllers/EmailConfirmationController.php"
]);

// create Route for "user/edit_question" => Controller-Path

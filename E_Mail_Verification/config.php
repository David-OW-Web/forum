<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 28.02.2019
 * Time: 11:45
 */

session_start();

define("DSN", "mysql:host=localhost;dbname=forum");
define("DB_USER", "root");
define("DB_PASS", "");

$pdo = new PDO("mysql:host=localhost;dbname=id9087034_forum", "id9087034_forum", "davidPHP3306");


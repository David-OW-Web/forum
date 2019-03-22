<?php

// welcome to dashboard

// echo "welcome to dashboard";

if(!isset($_SESSION['forum_user'])) {
    header("Location: ../index");
}

require 'app/Views/dashboard.view.php';
// require 'app/Views/dashboard.sidebar.view.php';

// require 'app/Views/dashboard.view.php';
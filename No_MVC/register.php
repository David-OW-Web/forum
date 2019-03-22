<?php
require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Constants.php';
require 'includes/classes/Account.php';
require 'includes/classes/Navigation.php';

$registerObj = new Account();

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pic = $_FILES['profile_pic']['name'];
    $pic_tmp = $_FILES['profile_pic']['tmp_name'];
    move_uploaded_file($pic_tmp, "images/profile_pic/$pic");
    $status = 1;

    $register = $registerObj->Register($email, $username, $password, $pic, $status);

    if ($register) {
        $_SESSION['forum_user'] = $username;
        header("Location: login.php");
    }
}
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
    <?php require 'includes/navbar.php'; ?>
    <div class="register">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="email">Email</label>
            <?php echo $registerObj->getError(Constants::$invalidEmail); ?>
            <?php echo $registerObj->getError(Constants::$emailTaken); ?>
            <?php echo $registerObj->getError(Constants::$emailTooLong); ?>
            <input value="<?php echo @$email; ?>" type="text" id="email" name="email" placeholder="email@domain.com">

            <label for="username">Username</label>
            <?php echo $registerObj->getError(Constants::$usernameTaken); ?>
            <?php echo $registerObj->getError(Constants::$usernameTooLong); ?>
            <input value="<?php echo @$username; ?>" type="text" id="username" name="username" placeholder="Username">

            <label for="profile_pic">Profilbild</label>
            <?php echo $registerObj->getError(Constants::$fileNameTooLong); ?>
            <input type="file" id="profile_pic" name="profile_pic">

            <label for="password">Passwort</label>
            <?php echo $registerObj->getError(Constants::$passwordTooLong); ?>
            <input type="password" id="password" name="password">

            <input type="checkbox" id="show_password" onclick="togglePassword('password')">
            <label for="show_password">Passwort anzeigen</label>

            <button type="submit" name="register">Registrieren</button>
        </form>
    </div>
</div>
<script src="js/togglePassword.js"></script>
</body>
</html>
<?php
require 'includes/config.php';
require 'includes/DB.php';
require 'includes/classes/Constants.php';
require 'includes/classes/Account.php';
require 'includes/classes/Navigation.php';
require 'includes/classes/Question.php';

$loginObj = new Account();
$questionObj = new Question();

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $loginObj->Login($email, $password);
    if($login) {
        $user_id = $questionObj->getUserIdByCurrentSession($_SESSION['forum_user']);
        $session_id = session_id();
        $public_ip = $loginObj->getRealIpAddr();
        $insertData = $loginObj->InsertLoginActivity($session_id, $user_id, $public_ip);
        unset($_SESSION['inactivity_message']);
        $_SESSION['last_login'] = time();
        header("Location: user/dashboard.php");
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
    <?php if(isset($_SESSION['inactivity_message'])): ?>
        <p><?php echo $_SESSION['inactivity_message']; ?></p>
    <?php endif; ?>
    <div class="login">
    <form action="" method="post">
        <label for="email">Email</label>
        <?php echo $loginObj->getError(Constants::$emailDoesNotExist); ?>
        <?php echo $loginObj->getError(Constants::$loginFailed); ?>
        <?php echo $loginObj->getError(Constants::$accountClosed); ?>
        <input value="<?php echo @$email; ?>" type="text" id="email" name="email" placeholder="domain@example.com">

        <label for="password">Passwort</label>
        <input type="password" id="password" name="password">

        <button type="submit" name="login">Login</button>
    </form>
    </div>
</div>
</body>
</html>

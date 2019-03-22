<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<div class="wrapper">
    <div class="login">
        <form action="" method="post">
            <label for="email">E-Mail</label>
            <?php echo $loginObj->getError(Constants::$emailDoesNotExist); ?>
            <?php echo $loginObj->getError(Constants::$loginFailed); ?>
            <?php echo $loginObj->getError(Constants::$accountClosed); ?>
            <input value="<?php echo @$email; ?>" type="text" id="email" name="email" placeholder="email@domain.com">

            <label for="password">Ihr Passwort</label>
            <input type="password" id="password" name="password">

            <p>Sie haben noch keinen Account? - <a href="register">Account erstellen</a></p>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>
</body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Details aktualisieren</title>
</head>
<body>
    <div class="wrapper">
        <?php require 'app/Views/dashboard.sidebar.view.php'; ?>
        <div class="container">
            <h1>Details aktualisieren</h1>
                <form action="" method="post">
                    <label for="about">Über mich</label>
                    <?php echo $accountObj->getError(Constants::$aboutAlreadyMade); ?>
                    <input type="text" id="about" name="about">

                    <button type="submit" name="about_me">About</button>
                </form>

            <h3>Passwort ändern</h3>
            <?php echo $msg; ?>
                <form action="" method="post">
                    <label for="current_password">Aktuelles Passwort</label>
                    <?php echo $accObj->getError(Constants::$passwordIncorrect); ?>
                    <input type="text" id="current_password" name="current_password">

                    <label for="new_password">Neues Passwort</label>
                    <?php echo $accObj->getError(Constants::$passwordTooLong); ?>
                    <input type="text" id="new_password" name="new_password">

                    <button type="submit" name="change_password">Passwort aktualisieren</button>
                </form>
        </div>
    </div>
</body>
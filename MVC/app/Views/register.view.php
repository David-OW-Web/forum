<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Registrieren</title>
</head>
<body>
<div class="wrapper">
    <div class="register">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="email">E-Mail</label>
            <!-- Errors each -->
            <?php echo $registerObj->getError(Constants::$invalidEmail); ?>
            <?php echo $registerObj->getError(Constants::$emailTaken); ?>
            <?php echo $registerObj->getError(Constants::$emailTooLong); ?>
            <input type="text" id="email" name="email" placeholder="email@domain.com">

            <label for="username">Username</label>
            <?php echo $registerObj->getError(Constants::$usernameTaken); ?>
            <?php echo $registerObj->getError(Constants::$usernameTooLong); ?>
            <input type="text" id="username" name="username">

            <label for="password">Passwort</label>
            <?php echo $registerObj->getError(Constants::$passwordTooLong); ?>
            <input type="password" id="password" name="password">
            <!-- Passwort anzeigen -->

            <label for="profile_pic">Profilbild</label>
            <?php echo $registerObj->getError(Constants::$fileNameTooLong); ?>
            <input type="file" id="profile_pic" name="profile_pic">

            <button type="submit" name="register">Registrieren</button>
        </form>
    </div>
</div>
</body>
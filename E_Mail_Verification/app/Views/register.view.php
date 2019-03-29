<head>
  <title>Registrieren</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <div class="register">
    <?php echo $msg; ?>
      <form action="" method="post" enctype="multipart/form-data">
        <label for="email">E-Mail</label>
        <?php echo $registerObj->getError(Constants::$invalidEmail); ?>
        <?php echo $registerObj->getError(Constants::$emailTooLong); ?>
        <?php echo $registerObj->getError(Constants::$emailTaken); ?>
        <input type="text" id="email" name="email">

        <label for="username">Username</label>
        <input type="text" id="username" name="username">

        <label for="password">Passwort</label>
        <input type="password" id="password" name="password">

        <label for="password2">Passwort wiederholen</label>
        <input type="password" id="password2" name="password2">

        <label for="profile_pic">Profilbild</label>
        <input type="file" id="profile_pic" name="profile_pic">

        <p>Sie haben schon einen Account? - <a href="login">Hier einloggen</a></p>

        <button type="submit" name="register">Registrieren</button>
      </form>
    </div>
  </div>
</body>

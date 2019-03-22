<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Meine Aktivität</title>
</head>
<body>
<div class="wrapper">
    <?php require 'dashboard.sidebar.view.php'; ?>
    <div class="container">
        <?php foreach($logins as $login): ?>
            <div class="login-activity">
                <p>Login-Datum: <?php echo $login['login_date']; ?></p>
                <p>Browser: <?php echo $login['user_agent']; ?></p>
                <p>IP-Adresse: <?php echo $login['ip_address']; ?></p>
                <div class="button-group" style="color: black;">
                    <a href="login_activity?delete_id=<?php echo $login['login_id']; ?>">Ja, das war ich</a>
                    <a href="login_activity?update_status_id=<?php echo $login['login_id']; ?>">Unbekannt</a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php echo $accObj->getError(Constants::$accountInDanger); ?>
    </div>
</div>
</body>
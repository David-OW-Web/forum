<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Details : <?php echo $_SESSION['forum_user']; ?></title>
</head>
<body>
    <div class="wrapper">
    <?php require 'app/Views/dashboard.sidebar.view.php'; ?>
    <?php foreach ($infos as $info): ?>
        <div class="container">
            <p>Mitglied seit: <?php echo $info['created_at']; ?></p>
            <p><?php echo $info['email']; ?></p>
            <p><?php echo $info['username']; ?></p>
            <?php if ($info['profile_pic'] == ""): ?>
                <p>Kein Profilbild vorhanden!</p>
            <?php else: ?>
                <img src="../images/profile_pic/<?php echo $info['profile_pic']; ?>" alt="">
            <?php endif; ?>
            <?php $getStatus = $dashboardObj->getAccountStatusByStatusId($info['fk_account_status_id']); ?>
            <?php foreach ($getStatus as $status): ?>
                <p>Accountstatus: <?php echo $status['description']; ?></p>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?> <!-- Anzeigen wie viele Fragen der User schon gestellt hat und vielleicht noch Antworten -->

    </div>
</body>
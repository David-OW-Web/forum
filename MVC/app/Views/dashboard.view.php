<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Dashboard : <?php echo $_SESSION['forum_user']; ?></title>
</head>
<body>
    <div class="wrapper">
        <?php require 'app/Views/dashboard.sidebar.view.php'; ?>
        <div class="container">
        <h1>Hallo, <?php echo $_SESSION['forum_user']; ?></h1>
        <p>Links</p>
        <ul>
            <li><a href="change_details">Details aktualisieren</a></li>
            <li><a href="create_question">Frage Stellen</a></li>
            <li><a href="../logout">Logout</a></li>
        </ul>
        <!-- Online Users -->
        </div>
    </div>
</body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Kategorie hinzufügen</title>
</head>
<body>
<div class="wrapper">
    <?php require 'dashboard.sidebar.view.php'; ?>
    <div class="container">
        <form action="" method="post">
            <label for="title">Titel</label>
            <?php echo $questionObj->getError(Constants::$categoryExists); ?>
            <input type="text" id="title" name="title">

            <label for="description">Beschreibung</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <button type="submit" name="add_category">Kategorie hinzufügen</button>
        </form>
    </div>
</div>
</body>
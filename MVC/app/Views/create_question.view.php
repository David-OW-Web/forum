<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Frage erstellen</title>
</head>
<body>
<div class="wrapper">
<?php require 'dashboard.sidebar.view.php'; ?>

<div class="container">
    <form action="" method="post">
        <label for="title">Titel (Kurzbeschreibung)</label>
        <input type="text" id="title" name="title">

        <label for="question">Frage</label>
        <textarea name="question" id="question" cols="30" rows="10"></textarea>

        <label for="category">Kategorie</label>
        <select name="cat_id" id="category">
            <option value="">Wähle eine Kategorie</option>
            <?php foreach($cats as $cat): ?>
                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="create_question">Frage stellen</button>
    </form>
</div>
</div>
</body>
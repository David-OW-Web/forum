<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title><?php echo @$_GET['q']; ?></title>
</head>
<body>
<div class="wrapper">
    <div class="search-bar-left">
        <form action="search" method="get">
            <label for="keyword">Suchbegriff</label>
            <input type="text" id="keyword" name="q" placeholder="Suche eingeben">
            <button type="submit">Suchen</button>
        </form>
    </div>

    <div class="search-results">
        <p><?php echo $numResults; ?> Resultate für Ihre Suche</p>
        <?php foreach($results as $result): ?>
        <div class="result-container">
            <p>Frage von <a href="account?id=<?php echo $result['fk_user_id']; ?>"><?php echo $result['question_from']; ?></a></p>
            <a href="question?id=<?php echo $result['question_id']; ?>"><?php echo $result['question_title']; ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
<h1 class="title">Neueste Fragen</h1>
<div class="wrapper">
    <div class="grid-container">
        <div class="newest-questions">
            <?php foreach($n_questions as $n_question): ?>
                <div class="question-card">
                    <p>Frage von <a href="account?id=<?php echo $n_question['fk_user_id']; ?>"><?php echo $n_question['question_from']; ?></a></p>
                    <p><?php echo $n_question['created_at']; ?></p>
                    <p><?php echo $n_question['question_title']; ?></p>
                    <a href="question?id=<?php echo $n_question['question_id']; ?>">Zur Frage</a>
                    <?php $answers = $questionObj->getAnswersFromQuestionById($n_question['question_id']); ?>
                    <p><?php echo $answers; ?> Antworten</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="search-bar">
        <form action="search" method="get">
            <label for="keyword">Suchbegriff</label>
            <input type="text" id="keyword" name="q" placeholder="Suche eingeben">
            <button type="submit">Suchen</button>
        </form>
    </div>

    <div class="grid-container">
        <?php if(is_array($pagination)): ?> <!-- @$pagination weil es sonst Notice ausgibt -->
        <?php foreach($pagination as $pag): ?>
        <div class="question-card">
            <p>Frage von <a href="account?id=<?php echo $pag['fk_user_id']; ?>"><?php echo $pag['question_from']; ?></a></p>
            <p><?php echo $pag['created_at']; ?></p>
            <p><?php echo $pag['question_title']; ?></p>
            <a href="question?id=<?php echo $pag['question_id']; ?>">Zur Frage</a>
            <?php $answers = $questionObj->getAnswersFromQuestionById($pag['question_id']); ?>
            <p><?php echo $answers; ?> Antworten</p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php echo $link; ?>
</div>
</body>
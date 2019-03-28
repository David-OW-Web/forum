<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <div class="question-container">
        <?php foreach ($questions as $question): ?>
            <strong><?php echo $question['question_title']; ?></strong>
            <p>Frage erstellt am: <?php echo $question['created_at']; ?></p>
            <p>Frage gestellt von: <a href="account?id=<?php echo $question['fk_user_id']; ?>"><?php echo $question['question_from']; ?></a></p>
            <!-- Status der Frage -->
            <p><?php echo $question['question_content']; ?></p>
        <?php endforeach; ?>
    </div>

    <?php echo $answerObj->getError(Constants::$noAnswers); ?>

    <div class="question-options">
        <p><?php echo $numAnswers; ?> Antworten</p>
        <form action="" method="post">
            <label for="sort">Antworten sortieren</label>
            <select name="sort" id="sort">
                <option value="">Sortieren nach</option>

                <option value="1">Neueste Antworten</option>
                <option value="2">Älteste Antworten</option>
            </select>

            <button type="submit" name="sort1">Sortieren</button>
        </form>
    </div>

    <div class="container">
        <?php foreach($answers as $answer): ?>
            <div class="answer-container">
                <p>Antwort von: <a href="account?id=<?php echo $answer['fk_user_id']; ?>"><?php echo $answer['answer_from']; ?></a></p>
                <p>Antwort am <?php echo $answer['created_at'] ?></p>
                <p><?php echo $answer['answer_content']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-container">
    <form action="" method="post">
        <label for="answer">Antwort</label>
        <textarea name="answer" id="answer" cols="30" rows="10"></textarea>

        <button type="submit" name="answer_question">Antworten</button>
    </form>
    </div>
</div>
</body>
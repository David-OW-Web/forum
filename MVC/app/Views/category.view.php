<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Kategorie</title>
</head>
<body>
<div class="wrapper">
<?php foreach($cats as $cat): ?>
    <h1 class="title"><!-- Fragen von Kategorie: --><?php echo $cat['cat_title']; ?></h1>
<?php endforeach; ?>
<div class="grid-container">
<!-- Start foreach loop here -->
<?php foreach($questions as $question): ?>
    <div class="question-card">
        <p>Frage von: <a href="account?id=<?php echo $question['fk_user_id']; ?>"><?php echo $question['question_from']; ?></a></p>
        <p><?php echo $question['created_at']; ?></p>
        <p><?php echo $question['question_title']; ?></p>
        <a href="question?id=<?php echo $question['question_id']; ?>">Zur Frage</a>
        <?php $numAnswers = $questionObj->getAnswersFromQuestionById($question['question_id']); ?>
        <p><?php echo $numAnswers; ?></p>
    </div>
<?php endforeach; ?>        
</div>
</div>
</body>
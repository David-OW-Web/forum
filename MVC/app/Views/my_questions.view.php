<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dashboard.style.css">
    <title>Meine Fragen</title>
</head>
<body>
    <div class="wrapper">
        <?php require 'app/Views/dashboard.sidebar.view.php'; ?>
        <div class="container">
            <h1>Meine Fragen</h1>
            <?php foreach($questions as $question): ?>
                <div class="question-card">
                    <a href="../question?id=<?php echo $question['question_id']; ?>"><?php echo $question['question_title']; ?></a>
                    <!-- Status ändern | Löschen | Bearbeiten | -->
                    <a href="?delete_id=<?php echo $question['question_id']; ?>"><?php echo $question['question_title']; ?> - Löschen</a>
                </div>
            <?php endforeach; ?>
        </div>
</body>
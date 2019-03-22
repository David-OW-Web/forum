<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Account</title>
</head>
<body>
<div class="wrapper">
    <?php require 'app/Views/dashboard.sidebar.view.php'; ?>
    <aside class="user-sidebar">
    <div class="user-info">
        <strong>Übersicht</strong>
        <p><?php echo $numA; ?> Antworten</p>
        <p><?php echo $numQ; ?> Fragen</p>
    </div>

    <?php foreach($infos as $about): ?>
    <div class="about">
        <strong>Über mich</strong>
        <p><?php echo $about['about_content']; ?></p>
    </div>
    <?php endforeach; ?>

        <?php foreach($user_infos as $info): ?>
        <div class="user-details">
            <img src="images/profile_pic/<?php echo $info['profile_pic']; ?>" width="300px" alt="">
            <strong><?php echo $info['username']; ?></strong>
            <p>Mitglied seit <?php echo $info['created_at']; ?></p>
        </div>
        <?php endforeach; ?>
    </aside>

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'question')">Fragen</button>
        <button class="tablinks" onclick="openTab(event, 'answer')">Antworten</button>
    </div>

        <div class="tabcontent" id="question">
            <?php echo $accountObj->getError(Constants::$userNoQuestions); ?>
            <?php foreach($questions as $question): ?>
            <div class="tabcontainer">
                <a href="question?id=<?php echo $question['question_id']; ?>"><?php echo $question['question_title']; ?></a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="tabcontent" id="answer">
            <?php echo $accountObj->getError(Constants::$userNoAnswers); ?>
            <?php foreach($answers as $answer): ?>
            <div class="tabcontainer">
                <p><?php echo $answer['answer_content']; ?></p>
                <p><?php echo $answer['created_at']; ?></p>
                <a href="question?id=<?php echo $answer['fk_question_id']; ?>">Zur Frage</a>
            </div>
            <?php endforeach; ?>
        </div>
</div>
<script src="horizontal_tabs.js"></script>
</body>
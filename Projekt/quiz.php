<?php
/*küsimuste kuvamise leht
 * Veebiprogrammeerimise projekt "Viktoriin"
 * Koostajad: Kaidi-Liis Liim, Maritana Sampu, Sigrid Kimask, Anelle Avaste
 */
    require("quizfunctions.php");
    $questionNumber = mt_rand(1,20);
    $question = getQuestion($questionNumber);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Viktoriin</title>
</head>
<body>
 <div class="container">
    <div class="quiz">
        <h1><?php echo $question->question; ?></h1>
        <ul>
            <li><?php echo $question->option1; ?></li>
            <li><?php echo $question->option2; ?></li>
            <li><?php echo $question->option3; ?></li>
            <li><?php echo $question->option4; ?></li>
        </ul>
    </div>
</div>
</body>
</html>
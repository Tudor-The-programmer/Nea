<?php

session_start();

$subject = $_GET['subject'];
$unit = $_GET['Unit'];


$path = $_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/' . $subject . '/' . $unit . '.csv';

$file_to_read = fopen($path, 'r');

while (!feof($file_to_read)) {
    $questionArray[] = fgetcsv($file_to_read, 1000, ',');
}
fclose($file_to_read);

$questions = fopen($path, 'r') or die('Failed to load questions');
$header = fgetcsv($questions);

?>

<!------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/StudyPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">
    <title>Sudy hard!</title>
</head>

<body>
    <div class="title-container">
        <?php
        echo '<h1>' . $subject . '</h1>';
        echo '<h2>' . $unit . '</h2>';
        //This is a way to pass through to the javascrip as a variable to manipulate
        //It doesnt appear as the styling makes it not exists to the user
        echo '<div id="invisible">' . json_encode($questionArray) . '</div>';
        ?>
    </div>


    <div class="contentainer">
        <div class="question" id="question">
            <button onclick="quiz.handleClick()">Toggle answer</button>
            <button onclick="quiz.handleClick()">Next question</button>
        </div>
        <script src="../Scripts/tes.js"></script>
</body>


</html>
<?php

session_start();

$subject = $_GET['subject'];
$unit = $_GET['Unit'];


$path = $_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/' . $subject . '/' . $unit . '.csv';

if (($open = fopen($_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/' . $subject . '/' . $unit . '.csv', "r")) !== FALSE) {

    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        $array[] = $data;
    }

    fclose($open);
}

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

        ?>
    </div>

    <?php
    //This is a way to pass through to the javascrip as a variable to manipulate
    //It doesnt appear as the styling makes it not exists to the user
    echo '<div id="invisible">' . json_encode($array) . '</div>';
    ?>
    <div class="container">
        <div class="contentainer">
            <div id="question-or-answer">

            </div>
        </div>
        
        <div id="display-text">
            <div id="question"></div>
            <div id="answer"></div>
        </div>
        <div id="button-field">
            <button id="show-answer-button">Show answer</button>
        </div>

        <div id="how-did-you-do">
            <button id="good">
                Good
            </button>
            <button id="okay">
                Okay
            </button>
            <button id="bad">
                Bad
            </button>

        </div>
    </div>
    </div>





    <script type="module" src="../Scripts/StudyPage.js"></script>

</body>


</html>
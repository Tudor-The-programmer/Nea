<?php

session_start();

//session variables needed
$uname = $_SESSION['uname'];

//The information given by the url
$subject = $_GET['subject'];
$unit = $_GET['Unit'];

//Where the details of their quiz will be stored
$recordsPath = $_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/Scores/' . $uname . '.csv';

//this will open up the file in the path of the CSV file and then enter in read mode to ensure nothin will be changed
if (($open = fopen($_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/' . $subject . '/' . $unit . '.csv', "r")) !== FALSE) {
    //the use of '1000' here is simply to ensure it has passed through the entire array
    //No study set would ever go over 1000 lines 
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        //Creates an array for each line of the csv file, making it a 2d array
        $array[] = $data;
    }

    fclose($open);
}

if (isset($_POST['submit'])) {
    header('Location: http://localhost/nea/Pages/Handler.php?subject=' . $subject . '&Unit=' . $unit);
}

?>

<!------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudy hard!</title>

    <link rel="stylesheet" href="../Styles/StudyPage.css">

    <!--The type module is needed to allow the imports of the file, in this case the MainFunctions class-->
    <script type="module" src="../Scripts/StudyPage.js" defer></script>
    <!--This is for the import of the spashPage function-->
    <script type="module" src="../Scripts/Quiz/MainFunctions.js" defer></script>


</head>

<body>
    <div class="title-container">
        <?php
        echo '<h1 id="subject">' . $subject . '</h1>';
        echo '<h2 id="unit">' . $unit . '</h2>';

        ?>
    </div>

    <?php
    //This is a way to pass through to the javascrip as a variable to manipulate
    //It doesnt appear as the styling makes it not exists to the user
    echo '<div id="invisible">' . json_encode($array) . '</div>';
    ?>
    <div class="back-btn">
        <a href="./MainPage.php" class="back">Back</a>
    </div>
    <div class="container">
        <div id="display-text">
            <div id="question"></div>
            <div id="answer"></div>
        </div>

        <div class="button-container">
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
                <button id="again">
                    Again
                </button>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
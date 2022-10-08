<?php

session_start();
$name = $_SESSION['uname'];
$subjects = $_SESSION['subjects'];

$path = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Scores/' . $name . '.csv';

$file = fopen($path, 'r');
$data = fgetcsv($file, 1000, ',');


function listOfAllScores($file)
{
    while (($line = fgetcsv($file)) !== false) {
        echo '<h2 id="subject" >' . $line[0] . '</h2>';
        echo '<h3 id="unit">' . $line[1] . '</h3>';
        echo '<div id="smaller-information">';
        echo '<p id="spacer">' . $line[2] . '</p>';
        echo '<p>' . $line[3] . '</p>';
        echo '<p id="spacer">' . $line[4] . '</p>';
        echo '</div>';
    }
    fclose($file);
}

function obtainStats($file)
{
    while (($line = fgetcsv($file)) !== false) {
        $subject[] = $line[0];
    }
}

?>

<!-------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Summay.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">
</head>

<body>
    <div class="contentainer">
        <div class="scrolling-container">
            <?php

            listOfAllScores($file);

            ?>
        </div>
    </div>

    <div class="left">
        <h1 class="title">Summary</h1>

        <div class="stats">

        </div>
    </div>
</body>

</html>
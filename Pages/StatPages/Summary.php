<?php

session_start();
$name = $_SESSION['uname'];
$subjects = $_SESSION['subjects'];

$path = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Scores/' . $name . '.csv';

$file = fopen($path, 'r');
$data = fgetcsv($file, 10000, ',');

//All of the data collected
$all = scrapeInformation($file);
$subject = $all[0];
$unit = $all[1];
$score = $all[2];
$percentage = $all[3];
$date = $all[4];

function mostDoneSubject($subject)
{
    //max value returns the value in the array which appears most
    $most = max($subject);
    //Seperation for the oncoming css
    echo '<div class="header"> Your most done subject: </div>';
    //showing the value
    echo '<div class="fact">' . $most . '</div>';
}

function mostDoneUnit($unit)
{
    $most = max($unit);
    echo '<div class="header"> Your most done unit: </div>';
    echo '<div class="fact">' . $most . '</div>';
}

function leastDoneSubject($subject, $subjects)
{
    //Could have multiple not done subjects
    $notdone = array();
    //loop through the subjects
    foreach ($subjects as $sub) {
        //if they are not done, then add then to the array
        if (!in_array($sub, $subject)) {
            array_push($notdone, $sub);
        }
    }
    echo '<div class="header"> A subject(s) you have not done </div>';
    //For all the values in the array
    foreach ($notdone as $not) {
        //show then as not done
        echo '<div class="fact">' . $not . '</div>';
    }
}

//This will take in all of the information
function scrapeInformation($file)
{
    //Splitting the infomration into different arrays
    $subject = array();
    $unit = array();
    $score = array();
    $percentage = array();
    $date = array();

    //Obtaining the valuest to put into the arry
    while (($line = fgetcsv($file)) !== false) {
        array_push($subject, $line[0]);
        array_push($unit, $line[1]);
        array_push($score, $line[2]);
        array_push($percentage, $line[3]);
        array_push($date, $line[4]);
    }
    //Creatinf one large total array in order to return the values
    $totalarray = [$subject, $unit, $score, $percentage, $date];
    fclose($file);
    return $totalarray;
}


function listOfAllScores($file, $name)
{
    //this is needed for the processing of data
    $lines = array();

    //Newly added explicit file destination 
    $path = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Scores/' . $name . '.csv';
    $file = fopen($path, 'r');

    //While it is not at the end
    while (($line = fgetcsv($file)) !== false) {
        //add the line of csv to the initiated array
        array_push($lines, $line);
    }
    //Close the file for best programming practice
    fclose($file);

    //for each of the values in the array, going backwards
    for ($i = count($lines) - 1; $i >= 0; $i--) {
        //All of these values make up just one entry int the whole list 
        echo '<h2 id="subject" >' . $lines[$i][0] . '</h2>';
        echo '<h3 id="unit">' . $lines[$i][1] . '</h3>';
        echo '<div id="smaller-information">';
        echo '<p id="spacer">' . $lines[$i][2] . '</p>';
        echo '<p>' . $lines[$i][3] . '</p>';
        echo '<p id="spacer">' . $lines[$i][4] . '</p>';
        echo '</div>';
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
</head>

<body>
    <div class="contentainer">
        <div class="scrolling-container">
            <?php
            listOfAllScores($file, $name);
            ?>
        </div>
    </div>

    <div class="left">
        <h1 class="title">Summary</h1>

        <div class="stats">
            <?php
            mostDoneSubject($subject);
            mostDoneUnit($unit);
            leastDoneSubject($subject, $subjects);
            ?>
        </div>
    </div>
</body>

</html>
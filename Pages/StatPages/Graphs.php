<?php

session_start();
$subjects = $_SESSION['subjects'];
$name = $_SESSION['uname'];

error_reporting(0);

//initailize the variables
class Plots
{
    public $subject;
    //some are private as the user shouldnt be allowed to see them
    private $userFile;
    public $name;

    public function __construct($subject, $name)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->userFile = $_SERVER['DOCUMENT_ROOT'] . "/Nea/Databases/Scores/" . $this->name . '.csv';
        $this->dates = array();
        $this->scores = array();
        $this->units = array();
    }

    public function getDatesAndScores()
    {
        //open the file
        $file = fopen($this->userFile, 'r');
        while (!feof($file)) {
            $line = fgetcsv($file);
            //if the subject is the same as the one in the file
            if ($line[0] == $this->subject) {
                //add the date and score to the arrays
                if (isset($line[3]) && isset($line[4])) {
                    array_push($this->dates, $line[4]);
                    array_push($this->scores, $line[3]);
                    array_push($this->units, $line[1]);
                }
            }
        }
        fclose($file);
    }

    //Getters
    public function getDates()
    {
        echo json_encode($this->dates);
    }
    public function getScores()
    {
        echo json_encode($this->scores);
    }
    public function getUnits()
    {
        echo json_encode($this->units);
    }

    public function creatingAssociativeArray()
    {
        //create an associative array
        $array = array();
        //loop through the dates and scores
        for ($i = 0; $i < count($this->dates); $i++) {
            //add the date and score to the array as a key value pair with the x axis being the dates and the y axis being the scores
            array_push($array, array("label" => $this->dates[$i], "y" => $this->scores[$i], "indexLabel" => $this->units[$i]));
        }
        return $array;
    }
}



//Allows the user to select the subject
$subject = $_GET['subject'];

//create a new plot for that subject
$plots = new Plots($subject, $name);
//get the dates and scores
$plots->getDatesAndScores();
//create an associative array
$array = $plots->creatingAssociativeArray();


?>

<!---------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphs</title>
    <link rel="stylesheet" href="./Graphs.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">

    <script>
        //Allows the user to select their prefered chart type
        const loadChart = (mode) => {
            //this is an addon called CanvasJS which allows you to create graphs
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "dark2", // "light1", "light2", "dark1", "dark2"
                title: {
                    //title becomes the name of the subject
                    text: <?php echo json_encode($subject) ?>
                },
                axisY: {
                    title: "Score",
                    includeZero: true,
                    suffix: "%",
                    maximum: 100,
                    minimum: 0

                },
                data: [{
                    type: mode, //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($array, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
    <script>
        //When the window loads this function will run 
        window.onload = function() {
            //this is an addon called CanvasJS which allows you to create graphs
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "dark2", // "light1", "light2", "dark1", "dark2"
                title: {
                    //title becomes the name of the subject
                    text: <?php echo json_encode($subject) ?>
                },
                axisY: {
                    title: "Score",
                    includeZero: true,
                    suffix: "%",
                    maximum: 100,
                    minimum: 0

                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($array, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>
    <div id="button-container">
        <?php
        foreach ($subjects as $subject) {
            echo '<a href = "Graphs.php?subject=' . $subject . '">' . $subject . '</a>';
        }
        ?>
    </div>

    <div id="mode-container">
        <button onclick='loadChart("line")'>Line</button>
        <button onclick='loadChart("column")'>Bar</button>
        <button onclick='loadChart("area")'>Area</button>
    </div>

    <div id="date-container">
        <button id='date'>All time</button>
        <button id='date'>Year</button>
        <button id='date'>Month</button>
        <button id='date'>Week</button>
    </div>

    <a id='back-button' href="../MainPage.php">Back</a>

    <div id="chartContainer"></div>
    <!---THe script below is the addon-->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>
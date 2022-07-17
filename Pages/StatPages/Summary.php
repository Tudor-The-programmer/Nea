<?php

session_start();
$name = $_SESSION['uname'];

$path = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Scores/' . $name . '.csv';

$file = fopen($path, 'r');
$data = fgetcsv($file, 1000, ',');

//Obtaines all the Data from the csv file apart from the date as it is not needed.
while (($data = fgetcsv($file, 1000, ',')) !== false) {
    $Subject[] = $data[0];
    $Unit[] = $data[1];
    $Score[] = $data[2];
    $Percentage[] = $data[3];
}

//Used to find the Person's Most used Subject
function subjectTracker($Subject)
{
    //This counts all of the subjects in the array, and returns the number of times it is present
    $subjectCount = array_count_values($Subject);
    //This sorts it by accending order
    arsort($subjectCount);
    //This returns the first key of the array, which is the most common subject
    $subjectCount = array_keys($subjectCount);
    //This returns the value of the most common subject
    $subjectCount = $subjectCount[0];
    //This returns the name of the most common subject
    return $subjectCount;
}

//This is the most common subject
$mostUsedSubject = subjectTracker($Subject);

//conbines the units with subjects to create a new array
$combined = array_merge($Subject, $Unit);

echo json_encode($combined);




echo $mostUsedSubject;

?>

<!-------------------------------------------------------------------------------------------------------------------->
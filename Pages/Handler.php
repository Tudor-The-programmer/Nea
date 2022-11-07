<?php

session_start();
//Obtaining variables
$uname = $_SESSION['uname'];
$subject = $_GET['subject'];
$unit = $_GET['Unit'];

//The post method here refers to the form from the previous study page
$percentage = $_POST['percentage'];
$score = $_POST['score'];
//in built function to help with the graphing page
$date = date("Y/m/d");

//where the users scores are stored
$recordsPath = $_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/Scores/' . $_SESSION['uname'] . '.csv';

//values to be inputted into the database
$dbInput = array($subject, $unit, $score, $percentage, $date);

//Opens the database
$db = fopen($recordsPath, 'a') or die('Could not open');
//Places values
fputcsv($db, $dbInput);
fclose($db);

//Moves the user back to the main page
header('location: http://localhost/nea/Pages/MainPage.php');

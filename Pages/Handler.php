<?php

session_start();
$uname = $_SESSION['uname'];
$subject = $_GET['subject'];
$unit = $_GET['Unit'];

$percentage = $_POST['percentage'];
$score = $_POST['score'];
$date = date("Y/m/d");

$recordsPath = $_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/Scores/' . $_SESSION['uname'] . '.csv';



$dbInput = array($subject, $unit, $score, $percentage, $date);

$db = fopen($recordsPath, 'a') or die('Could not open');
fputcsv($db, $dbInput);
fclose($db);

header('location: http://localhost/nea/Pages/MainPage.php');

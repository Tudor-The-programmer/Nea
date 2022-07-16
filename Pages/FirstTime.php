<?php

session_start();
$uname = $_SESSION['uname'];

function getChecked()
{
    $subjects = [];
    if (isset($_POST['submit'])) {
        if (!empty($_POST['subjects'])) {
            foreach ($_POST['subjects'] as $selected) {
                array_push($subjects, $selected);
            }
        }
    }
    return $subjects;
}

$dbInput = getChecked();

if (count($dbInput) != 0) {
    $db = fopen($_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Users/' . $uname . '.csv', 'w') or die('Could not open');

    fputcsv($db, $dbInput);
    fclose($db);

    $db = fopen($_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Scores/' . $uname . '.csv', 'w');
    $headers = array('Subject', 'Unit', 'Score', 'Percentage', 'Date');
    fputcsv($db, $headers);

    fclose($db);

    $_SESSION['subjects'] = $dbInput;

    header('Location: http://localhost/nea/Pages/MainPage.php');
    exit();
}
?>

<!-------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Styles/FirstTIme.css">
</head>

<body>
    <div class="text-space">
        <div class="text-styles">
            <h1>
                Glad you made it!
            </h1>
            <p>
                Select what you want to do:
            </p>
        </div>

    </div>

    <form action="./FirstTime.php" method="post" id='form'>
        <div class="button-container">
            <input type="submit" value="Happy? click here!" class="submit-button" name='submit'>
        </div>

    </form>
</body>


<script src="../Scripts/FirstTime.js"></script>

</html>
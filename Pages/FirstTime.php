<?php

session_start();
$uname = $_SESSION['uname'];

//This function gets called upon submitting
function getChecked()
{
    $subjects = [];
    if (isset($_POST['submit'])) {
        //This stops a user from not checking anything and then submitting 
        if (!empty($_POST['subjects'])) {
            foreach ($_POST['subjects'] as $selected) {
                //this will form the array of subjects
                array_push($subjects, $selected);
            }
        }
    }
    return $subjects;
}

//creates the array needed to be added to the datbase
$dbInput = getChecked();

if (count($dbInput) != 0) {
    //As this is only called once in the users time, a database write can be used instead to 
    //create the database as well
    $db = fopen($_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Users/' . $uname . '.csv', 'w') or die('Could not open');

    //Puts the values into the database
    fputcsv($db, $dbInput);
    //Closes the database
    fclose($db);

    //Itialises a score database, also under the username as well
    $db = fopen($_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Scores/' . $uname . '.csv', 'w');
    //creates the headers for the csv
    $headers = array('Subject', 'Unit', 'Score', 'Percentage', 'Date');
    fputcsv($db, $headers);

    fclose($db);

    $_SESSION['subjects'] = $dbInput;

    //Transports the user to the main page
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
    <!--This contains the form for the subjects-->
    <form action="./FirstTime.php" method="post" id='form'>
        <div class="button-container">
            <!--The script will place the items into the DOM  into this form-->
            <!--The submit button is needed to be able to call the function from php-->
            <input type="submit" value="Happy? click here!" class="submit-button" name='submit'>
        </div>

    </form>
</body>


<script src="../Scripts/FirstTime.js"></script>

</html>
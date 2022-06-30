<?php

function createUserSubjectsDatabase($html)
{
    $subjects = [];
    foreach ($html->find('.chosen') as $selected) {
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" href="../Styles/FirstTIme.css">
</head>

<body>

    <h1 class='title'>Glad you made it</h1>
    <p class='subtext'>Scroll along the subject and pick what you do!</p>

    <!--Buuton which will call the function to create a user file-->
    <button class="submit-button">Happy? Click here!</button>


    <div class="space">

    </div>
</body>
<script src="../Scripts/Welcome.js"></script>

</html>
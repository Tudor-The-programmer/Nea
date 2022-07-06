<?php



?>

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
            <input type="submit" value="Happy? click here!" class="submit-button">
        </div>
        
    </form>
</body>


<script src="../Scripts/FirstTime.js"></script>

</html>
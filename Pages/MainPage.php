<?php
session_start();
$subjects = $_SESSION['subjects'];

function displaySubjects($subjects)
{
    foreach ($subjects as $subject) {
        echo '<a classname =subject >' . $subject . '</a>';
    }
}


?>

<!------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/MainPage.css">
</head>

<body>
    <h1 class="title">

        <?php echo 'Hello ' . $_SESSION['uname'] . '!'; ?>
    </h1>
    <div class="container">
        <nav>
            <a class="home">Home</a>
            <?php displaySubjects($subjects);
            echo $_SERVER['DOCUMENT_ROOT'] ?>
        </nav>
    </div>

</body>

<script src="../Scripts/MainPage.js"></script>

</html>
<?php

session_start();
$uname = $_SESSION['uname'];

function createRandomClassCode()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $_SESSION['classCode'] = $randomString;

    return $randomString;
}



?>

<!------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getting your code...</title>
    <link rel="stylesheet" href="../../Styles/CodePage.css">
</head>

<body>
    <h1>
        <?php echo 'Hello Teacher ' . $_SESSION['uname'] . '!'; ?>
    </h1>

    <div class="code">
        <h2>Class Code</h2>
        <p>
            <?php echo createRandomClassCode();

            //insert values into database
            $file = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/Classes/' . $_SESSION['classCode'] . '.csv';
            $db = fopen($file, 'w') or die("");
            //Puts the values into the csv file
            $dbInput = array($uname);
            fputcsv($db, $dbInput);
            //closes the file
            fclose($db);

            ?>
        </p>
    </div>

    <a href="TeacherMainPage.php">Wrote it down? Click here!</a>

</body>

</html>
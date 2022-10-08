<?php

session_start();
$uname = $_SESSION['uname'];

class SubjectTemplate
{
    public $subject;
    public $subjectFile;

    public function __construct($uname)
    {
        $this->subjectFile = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/UserCreatedSets';
        $this->subject = 'UserCreatedSets';
        $this->uname = $uname;
    }

    public function displayAllUnits()
    {
        // Display all units
        //No naming convention needed anymore now they can be given any name and the code will still work

        //Get all files in the subject folder
        $dir = $this->subjectFile;
        //Scans files in the subject folder
        $files = scandir($dir);
        //Loops through all files in the subject folder
        foreach ($files as $key => $value) {


            //Checks if the file is a directory
            //If it is a directory it will be skipped
            if ($value != '.' && $value != '..') {
                //This just removes the .csv for better readability and aesthetics
                $value = str_replace('.csv', '', $value);
                $value = str_replace('.txt', '', $value);

                $userThatCreatedTheSet = substr($value, strpos($value, "-") + 2);


                //This is the link to the Study page
                if ($userThatCreatedTheSet === $this->uname) {
                    echo '<a href = "StudyPage.php?subject=' . $this->subject . '&Unit=' . $value . '"><div id="unit">' . $value . '</div></a>';
                } else {
                    echo '';
                }
            }
        }
    }

    public function displayEveryonesUnits()
    {
        // Display all units
        //No naming convention needed anymore now they can be given any name and the code will still work

        //Get all files in the subject folder
        $dir = $this->subjectFile;
        //Scans files in the subject folder
        $files = scandir($dir);
        //Loops through all files in the subject folder
        foreach ($files as $key => $value) {


            //Checks if the file is a directory
            //If it is a directory it will be skipped
            if ($value != '.' && $value != '..') {
                //This just removes the .csv for better readability and aesthetics
                $value = str_replace('.csv', '', $value);
                $value = str_replace('.txt', '', $value);

                //Done to distinguish the sets from the users own to others that they may want to use
                $userThatCreatedTheSet = substr($value, strpos($value, "-") + 2);


                //This is the link to the Study page
                if ($userThatCreatedTheSet !== $this->uname) {
                    echo '<a href = "StudyPage.php?subject=' . $this->subject . '&Unit=' . $value . '"><div id="unit">' . $value . '</div></a>';
                } else {
                    echo '';
                }
            }
        }
    }
}

$userSets = new SubjectTemplate($uname);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/UserSets.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <div class="title">
        <h1>Hello <?php echo $uname ?>!</h1>
    </div>
    
    <div class="back-btn">
        <a href="./MainPage.php" class="back">Back</a>
    </div>

    <div class="contentainer">

        <div class="user-units-container">
            <h2>Your Units</h2>
            <div class="user-units">
                <?php
                $userSets->displayAllUnits()
                ?>
            </div>
        </div>


        <div class="other-units-container">
            <h2>Other Units you may want to try!</h2>
            <div class="other-units">
                <?php
                $userSets->displayEveryonesUnits()
                ?>
            </div>
        </div>

    </div>

</body>

</html>
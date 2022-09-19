<?php

session_start();
$subjects = $_SESSION['subjects'];
$uname = $_SESSION['uname'];

class SubjectTemplate
{
    public $subject;
    public $subjectFile;

    public function __construct($subject, $subjectFile)
    {
        $this->subjectFile = $subjectFile;
        $this->subject = $subject;
    }

    public function diplsyAllUnits()
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
                //This is the link to the Study page
                echo '<a href = "StudyPage.php?subject=' . $this->subject . '&Unit=' . $value . '"><div id="unit">' . $value . '</div></a>';
            }
        }
    }
}

function setUpUnits($subjects)
{
    foreach ($subjects as $subject) {
        //Initialise the subject template
        $sub = new  SubjectTemplate($subject, $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/' . $subject);
        echo '<div id="' . $subject . '2' . '" class="invisible panel ' . $subject . '">';
        print '<h3>' . $subject . '</h3>';
        echo '<ul>';
        //Display all units
        print '<a>' . $sub->diplsyAllUnits() . '</a>';
        echo '</ul>';
        echo '</div>';
    }
}





function displaySubjects($subjects)
{
    foreach ($subjects as $subject) {
        //This is added in order to work with the javascript
        //The javascript will use the subject name to display the correct units
        echo '<button class=subject onclick="toggleActive(id)" id ="' . $subject . '">' . $subject . '</a>';
    }
}


//Allowing the user to add their own csv files 
if (isset($_POST["submit"])) {

    if (isset($_FILES["file"])) {
        $dirpath = $_SERVER['DOCUMENT_ROOT'] . "/NEA/Databases/UserCreatedSets/";


        //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
        } else {
            //Print file details
            echo "<p id='file-stat'> File uploaded! </p>";

            //if file already exists
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/Databases/UserCreatesSets/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES['file']['tmp_name'], $dirpath . $_FILES['file']['name'] . '- ' . $_SESSION['uname']);
            }
        }
    } else {
        echo "No file selected <br />";
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
    <link rel="stylesheet" href="../Styles/MainPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">
    <title>Glad You're Here!</title>
</head>

<body>
    <div class="title">
        <h1>
            <?php echo 'Hello ' . $_SESSION['uname'] . '!'; ?>
        </h1>
    </div>

    <div class="tab-container">
        <nav>
            <button class="home active" onclick='toggleActive(id)' id="Home">Home</a>
                <?php displaySubjects($subjects); ?>
        </nav>
    </div>

    <div class="contentainer">
        <div class="text-area">
            <div class="panel" id='Home2'>
                <h3>
                    Home:
                </h3>

                <ul>
                    <a href='../Pages/StatPages/Summary.php'>Summary</a>
                    <a href='../Pages/StatPages/Graphs.php'>Graphs</a>
                    <a href="./UserSets.php">User Created sets</a>
                </ul>

                <div class="input-csv">
                    <form action="MainPage.php" method="post" enctype="multipart/form-data" id='file-input-form'>
                        <input id='file-form-input' type="file" name="file" value="" accept=".csv, .txt" />
                        <input id='file-form-input' type="submit" name="submit" value="Save" />
                    </form>
                </div>


            </div>

            <?php

            setUpUnits($subjects);

            ?>
        </div>
    </div>
</body>
<script src="../Scripts/MainPage.js"></script>

</html>
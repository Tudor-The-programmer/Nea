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
        $flag = true;
        $counter = 0;
        $unit = 1;
        while ($flag) {
            if (file_exists($this->subjectFile . '/Unit' . $unit . '.csv')) {
                $counter += 1;
                $unit += 1;
            } else {
                $flag = false;
            }
        }

        $x = 1;
        while ($x < $counter + 1) {
            echo '<a href="http://localhost/nea/Pages/StudyPage.php?subject=' . $this->subject .  '&Unit=Unit' . $x . '">' . 'Unit' . $x . '</a>';
            $x++;
        }
    }
}

function setUpUnits($subjects)
{
    foreach ($subjects as $subject) {
        $sub = new  SubjectTemplate($subject, $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/' . $subject);
        echo '<div id="' . $subject . '2' . '" class="invisible panel ' . $subject . '">';
        print '<h3>' . $subject . '</h3>';
        echo '<ul>';
        print '<a>' . $sub->diplsyAllUnits() . '</a>';
        echo '</ul>';
        echo '</div>';
    }
}



function displaySubjects($subjects)
{
    foreach ($subjects as $subject) {
        echo '<button class=subject onclick="toggleActive(id)" id ="' . $subject . '">' . $subject . '</a>';
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
                    <a href=' '>Progress</a>
                    <a href=' '>Most Worked On</a>
                    <a href=' '>Best Units</a>

                </ul>
            </div>

            <?php

            setUpUnits($subjects);

            ?>

        </div>
    </div>

</body>
<script src="../Scripts/MainPage.js"></script>

</html>
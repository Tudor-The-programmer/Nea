<?php

session_start();

function checkPassords($pass, $check)
{
    //simple function to ensure the user types their password correctly
    if ($pass != $check) {
        echo 'passwords do not match';
    } else {
        return true;
    }
}

function checkUsernames($username)
{
    //opens the csv file containing the users detailers
    $file = file($_SERVER['DOCUMENT_ROOT'] . '/Nea/Databases/Login.csv');
    //As PHP uses assosiative each element has a key and a value so this must be stated
    foreach ($file as $key => $value) {
        //This is creating a variable, for each line i the csv and the values are represented as an array
        $line = explode(",", $value);
        //we go into the first element in an array, which by my design is the username
        //If the username is present in the array we return a false as a flag
        if ($line[0] == $username) {

            echo '<div class="error">Username is already taken!</div>';
            return false;
        }
    }
    //otherwise username isnt in the array so we return a true
    return true;
}

//simple check to make sure all values are inputted
function isEmpty($credientials)
{
    //for every value the check will be false if there isnt any characters in the input
    foreach ($credientials as $values) {
        if (empty($values)) {
            echo '<div class="error">Input all fields please</div>';
            return false;
        }

        //This is code to fix the spacebar bug, if a user inputted spaces to trip the system this would catch it
        //The str_split method creates an array out of the characters and puts then in valid
        $valid = str_split($values);
        //It then checks the array for any space characters ' ' 
        if (in_array(' ', $valid)) {
            //if there is the subsiquent error message is presented and the check will be false
            echo '<div class="error">Spaces are invalid characters here!</div>';
            return false;
        }
    }
    return true;
}

//Added function for email check using the same method as the emtpy string check 
function emailCheck($email)
{
    $valid = str_split($email);
    if (!in_array('@', $valid)) {
        echo '<div class="error">Invalid email!</div>';
        return false;
    } else {
        return true;
    }
}

/*Now all of the checks are fininshed its now the functions for storing it*/
function signIn($dbInput, $uname, $passw)
{
    //opens the file in append mode
    /*Had a major issue with compatibnility across different devices as the path to the file would always change
    this change in the code allows for a remote user to input to file wihtout changing the path */
    $db = fopen($_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/login.csv', 'a') or die('Could not open');
    //Puts the values into the csv file 
    fputcsv($db, $dbInput);
    //closes the file
    fclose($db);

    //creates a session for the user
    $_SESSION['uname'] = $uname;
    $_SESSION['passw'] = $passw;

    //redirects the user to the First time page to enter their subjectes
    header('Location: http://localhost/nea/Pages/FirstTime.php');
    exit();
}

/*Creating the login function*/
function login($uname, $passw)
{


    //opens the csv file containing the users detailers
    $file = $_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/login.csv';
    if (($handle = fopen($file, "r")) !== FALSE) {
        //As PHP uses assosiative each element has a key and a value so this must be stated
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            //This is creating a variable, for each line i the csv and the values are represented as an array
            $pass = explode(",", $data[2]);
            $name = explode(",", $data[0]);

            //we go into the last element in an array, which by my design is the password
            //If the password is present in the array we return a true as a flag
            //This is used to check if the username is also present in the array
            if ($name[0] == $uname && password_verify($passw, $pass[0])) {
                //creates a session for the user

                //Pass through the subjects that the user has 
                $subjects = [];
                $subjectfile = fopen($_SERVER['DOCUMENT_ROOT'] . '/nea/Databases/users/' . $uname . '.csv', 'r') or die('Incorrect');
                while (($line = fgetcsv($subjectfile)) !== false) {
                    $subjects = $line;
                }

                $_SESSION['uname'] = $uname;
                $_SESSION['subjects'] = $subjects;


                //redirects the user to the First time page to enter their subjectes
                header('Location: http://localhost/nea/Pages/MainPage.php');
                exit();
            }
        }
        echo '<div class="error">Incorrect username or password</div>';
    }
}



//if the login button is pressed
if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $passw = $_POST['passw'];

    login($uname, $passw);
}




//if the signup button is pressed
if (isset($_POST['signup'])) {

    /*
    If a user signs up the different checks will be put in place to ensure the user doesnt
    1) Have the same username
    2) Passwords must match
    3) No fields are left blank
     */

    /*
    Added security features due to tests:
    1) Do not allow for spaces
    2) Make sure that email has an @
     */


    //Otherwise we can allow the user to be added to the database
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $passw = $_POST['passw'];
    $passwcheck = $_POST['passwcheck'];

    //Hashing the password for security
    $passw_hashed = password_hash($passw, PASSWORD_BCRYPT);

    //puts all data values into an array
    $credientials = array($uname, $email, $passw, $passwcheck);
    $dbInput = array($uname, $email, $passw_hashed, 'No');

    $check1 = checkPassords($passw, $passwcheck);
    $check2 = checkUsernames($uname);
    $check3 = isEmpty($credientials);
    $check4 = emailCheck($email);

    //Only if all of the criteria is met will the user be allowed in 
    if ($check1 == true and $check2 == true and $check3 == true and $check4 == true) {
        signIn($dbInput, $uname, $passw);
        $_SESSION['uname'] = $uname;
        header('Location: http://localhost/nea/Pages/FirstTime.php');
        exit();
    }
}

?>

<!---------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash(card)</title>
    <link rel="stylesheet" href="../Styles/Login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Work+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <div class="title">
        <h1>In a Flash(card)</h1>
    </div>
    <div class="container">
        <div class="buttons">
            <!--Both buttons will have a popup form on click will call each function-->
            <button class="login" onclick="togglelogin()">Login</button>
            <p>Select either login or sign up!</p>
            <button class="signup" onclick="toggleSignup()">Signup</button>
        </div>
        <!--The login form, the variables will pass though into the php and check with the database-->
        <form class="login-form" action="Login.php" method="post">
            <!--This is for the username section-->
            <label for="uname">Username: </label>
            <input type="text" name="uname" id="uname">
            <!--This is for the password section-->
            <label for="passw">Password: </label>
            <input type="password" name="passw" id="passw">
            <input class="submit-button" type="submit" value="Submit" name="login">
        </form>
        <form class="signup-form" action="Login.php" method="post">
            <!--This is for the email section-->
            <label for="email">Email: </label>
            <input type="text" name="email" id="email">
            <label for="uname">Username: </label>
            <input type="text" name="uname" id="uname">
            <label for="passw">Password: </label>
            <input type="password" name="passw" id="passw">
            <label for="passwcheck">Confirm password</label>
            <input type="password" name="passwcheck" id='passwcheck'>
            <input onclick="checkError()" class="submit-button" type="submit" value="Enter!" name="signup">
        </form>
    </div>
</body>

<!--Linking the js file------------------------>
<script src="../Scripts/Login.js"></script>

</html>
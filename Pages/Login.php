<?php

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
    $file = file('G:\Server\htdocs\Nea\Databases\Login.csv');
    //As PHP uses assosiative each element has a key and a value so this must be stated
    foreach ($file as $key => $value) {
        //This is creating a variable, for each line i the csv and the values are represented as an array
        $line = explode(",", $value);
        //we go into the first element in an array, which by my design is the username
        //If the username is present in the array we return a false as a flag
        if ($line[0] == $username) {

            echo 'Username is already taken!';
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
            echo 'Input all fields please';
            return false;
        }

        //This is code to fix the spacebar bug, if a user inputted spaces to trip the system this would catch it
        //The str_split method creates an array out of the characters and puts then in valid
        $valid = str_split($values);
        //It then checks the array for any space characters ' ' 
        if (in_array(' ', $valid)) {
            //if there is the subsiquent error message is presented and the check will be false
            echo 'Spaces are invalid characters here!';
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
        echo 'Invalid email!';
        return false;
    } else {
        return true;
    }
}

//if the login button is pressed
if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $passw = $_POST['passw'];

    //connect to the database
    $conn = mysqli_connect('localhost', 'tudor', 'ADMIN1', 'Login');

    //if the connection fails
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //sql to check the username and password is correct
    $sql = "SELECT COUNT(`NAME`)" . "FROM `users`" . "WHERE `NAME` = '$uname' AND `PASSWORD` = '$passw';";

    $result = mysqli_query($conn, $sql);
    $row = json_encode(mysqli_fetch_row($result));
    //if not error will appear
    /*
    NOTE: this is a strange work around, the json_encode creates a string of an array of an object, strange?
    Absolutely but does it work, yes! The index 2 just so happens to store the value of the amount of rows, if this is 0
    then no values are there meaning that there is not user by those details.
    */

    if ($row[2] == 0) {
        echo 'Invalid username and/or Password';
    } else {
        //if all is passed then it will go to the next user
        header('Location: http://localhost/nea/Pages/MainPage.php');
        exit();
    }
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
    //puts all data values into an array
    $credientials = array($uname, $email, $passw, $passwcheck);
    $dbInput = array($uname, $email, $passw);

    $check1 = checkPassords($passw, $passwcheck);
    $check2 = checkUsernames($uname);
    $check3 = isEmpty($credientials);
    $check4 = emailCheck($email);

    //Only if all of the criteria is met will the user be allowed in 
    if ($check1 == true and $check2 == true and $check3 == true and $check4 == true) {
        //opens the file in write mode
        $conn = mysqli_connect('localhost', 'tudor', 'ADMIN1', 'Login');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //the sql statements for the database:
        $sql = "INSERT INTO `users` (`NAME`, `EMAIL`, `PASSWORD`) VALUES ('$uname', '$email', '$passw')";

        if ($conn->query($sql) === TRUE) {
            header("Location: http://localhost/nea/Pages/FirstTime.php");
            exit();
        } else {
            echo "Error";
        }
    }
}

?>

<!-------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash(card)</title>
    <link rel="stylesheet" href="../Styles/Login.css">
</head>

<body>
    <div class="title">
        <h1>In a Flash(card)</h1>
    </div>
    <div class="container">
        <div class="buttons">
            <!--Both buttons will have a popup form-->
            <button class="login" onclick="togglelogin()">Login</button>
            <button class="signup" onclick="toggleSignup()">Singup</button>
        </div>
        <!--The login form, the variables will pass though into the php and check with the database-->
        <form class="login-form" action="Login.php" method="post">
            <label for="uname">Username: </label>
            <input type="text" name="uname" id="uname">
            <label for="passw">password: </label>
            <input type="password" name="passw" id="passw">
            <input type="submit" value="Submit" name="login">
        </form>
        <form class="signup-form" action="Login.php" method="post">
            <label for="email">Email: </label>
            <input type="text" name="email" id="email">
            <label for="uname">Username: </label>
            <input type="text" name="uname" id="uname">
            <label for="passw">Password: </label>
            <input type="password" name="passw" id="passw">
            <label for="passwcheck">Confirm password</label>
            <input type="password" name="passwcheck" id='passwcheck'>
            <input type="submit" value="Enter!" name="signup">
        </form>
    </div>
</body>

<!--Linking the js file-->
<script src="../Scripts/Login.js"></script>

</html>
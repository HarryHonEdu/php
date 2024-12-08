<?php
session_start();
session_regenerate_id(true);

//IP Address and User Agent Validation
if(!isset($_SESSION['ipAddress']) || !isset($_SESSION['user_agent']))
{
    $_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}

if ($_SESSION['ipAddress'] !== $_SERVER['REMOTE_ADDR'] ||
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) 
 {
    session_unset();
    session_destroy();
    die("Session validation failed.");
}

if(!(isset($_POST['name']) && !(isset($_POST['password']))))
{
    if(empty($_POST['name']))
    {
        echo "Please enter your username. <br>";
    }
    if(empty($_POST['password']))
    {
        echo "Please enter your password. <br>";
    }
}

$username = "admin";
$password = "1234";

//Check if the user has logged in before
if (isset($_SESSION['loggedIn']) === true)
{
    session_regenerate_id(true);
    $_SESSION['username'] = $username;
    header("Location: welcome.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
    <style>
        p { font-weight:bold; color: red;}
    </style>
    <body>
    <form action="" method="POST">
    Enter Username: <input type="text"name="name"><br>
    Enter Password: <input type="text"name="password"><br>
    <button type="submit">Login</button>
    </form>
    <?php

    if (!empty($_POST['name']))
    {
        if (!empty($_POST['password']))
        {
            if ($_POST['name'] == $username && $_POST['password'] == $password)
            {
                session_regenerate_id(true);
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                header("Location: welcome.php");
            }
            else if ($_POST['name'] != $username && $_POST['password'] == $password)
            {
                echo "Incorrect Username. Please Try Again.";
            }
            else if ($_POST['name'] == $username && $_POST['password'] != $password)
            {
                echo "Incorrect Password. Please Try Again.";
            }
            else {
                echo "<p>Incorrect Username and Password. Please Try Again.</p>";
            }
        }
    }
    ?>
    </body>
</html>
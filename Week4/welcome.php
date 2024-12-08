<?php
session_start();

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

session_regenerate_id(true);

//Set Inactive minutes (In Seconds)
$timeout = 300;

//Timeout Function
if (isset($_SESSION['LastActive']))
{
    $elapsed_time = time() - $_SESSION['LastActive'];
    if ($elapsed_time > $timeout)
    {
        session_regenerate_id(true);
        session_unset();
        session_destroy();
        header("Location: login_session.php");
        exit();
    }
}

$_SESSION['LastActive'] = time();

echo "Login Successful. Welcome " . $_SESSION['username'] . "!";
?>

<!DOCTYPE html>
<html>
    <body>
        <form action="logout.php" method="POST">
            <button type="submit">Log out</button>
        </form>
    </body>
</html>
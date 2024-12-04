<?php

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
?>
<!DOCTYPE html>
<html>
    <style>
        p { font-weight:bold; color: red;}
    </style>
    <body>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    Enter Username: <input type="text"name="name"><br>
    Enter Password: <input type="text"name="password"><br>
    <input type="submit">
    </form>
    <?php
    $username = "admin";
    $password = "1234";
    if (!empty($_POST['name']))
    {
        if (!empty($_POST['password']))
        {
            if ($_POST['name'] == $username && $_POST['password'] == $password)
            {
                echo "Login Successful.";
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
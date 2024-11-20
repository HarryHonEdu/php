<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
        const username = "Harry";
        const password = "1234";

        $inputUsername = "Harry";
        $inputPassword = "1234";

        if ($inputUsername == username)
        {
            if($inputPassword == password)
            echo "Login Successful!";
            else
            echo "Invalid Password!";
        } else
        {
            echo "Invalid Username!";
        }


        ?>
    </body>
</html>
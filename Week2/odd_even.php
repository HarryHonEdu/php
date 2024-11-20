<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
        $num = rand(1, 10);

        if ($num % 2 == 0)
        {
            echo $num . " is Even";
        } else {
            echo $num . " is Odd";
        }
        ?>
    </body>
</html>
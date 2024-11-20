<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
        for ($x = 1; $x <= 100; $x++)
        {
            if ($x % 2 == 0)
            echo $x . "<br>";
        }

        echo "<br>";

        for ($a = 0; $a <= 100; $a += 2)
        {
            echo $a . "<br>";
        }
        ?>
    </body>
</html>
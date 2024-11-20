<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
        $sum = 0;
        for ($a = 1; $a <= 10; $a++)
        {
            $sum += $a;
            echo $sum . "<br>";
        }

        echo "<br> Sum of first natural number is: " . $sum;
        ?>
    </body>
</html>
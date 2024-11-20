<!DOCTYPE html>
<html>
    <head>
    <style>
        .text {
            font-weight: bold;
            font-size: large;
            color: salmon;
        }
    </style>
    </head>
    <body>
        <?php
        $r1 = rand(1,10);
        $r2 = rand(1,10);

        
        
        if ($r1 > $r2) { echo " <h1 class=text>" . $r1 . " </h1>"; }
        else { echo $r1 . "<br>"; }
        echo $r2 . "<br>";
        ?>
    </body>
</html>
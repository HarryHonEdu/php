<!DOCTYPE html>
<html>
    <head>
    <title>Random Number</title>
    <style>
        .line1 {font-style: italic; color: green;}
        .line2 {font-style: italic; color: blue;}
        .line3 {font-style: bold; color: red;}
        .line4 {font-style: bold; color: black;}
        .extra {font-style: italic;}
    </style>
    </head>
    <body>
        <?php
        $randNum = rand(100,200);
        $randNum2 = rand(100,200);
        ?>

        <?php
        echo "<h2 class=\"line1\"> First Random Number: " . $randNum . "</h2>";
        echo "<h2 class=line2> Second Random Number: " . $randNum2 . "</h2>";
        echo "<h2 class=line3> Sum of Two Variables: " . $randNum + $randNum2 . "</h2>";
        echo "<h2 class=line4> Multiplication of Two Variables: <span class=extra>" . $randNum * $randNum2 . "</span>";
        ?>

    </body>
</html>
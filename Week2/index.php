<!DOCTYPE html>
<html>
    <head>
    <style>
        body {background-color: salmon;}
        .textcolor {color: darkturquoise; margin: 1px;}
        .date-style {font-size: 25px; color: darkorchid;}
    </style>
    <title>Week2 PHP Script</title>
    </head>
    <body>

    <?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    echo "<h2 class=textcolor> Harry Hon Hok Jun</h2>" . "<br>";
    $date = date("d/M/Y");
    echo "<br>";
    echo date("h:i:sa");
    ?>

    <div class="date-style">
        <?php
        echo $date;
        ?>
    </div>

    </body>
</html>
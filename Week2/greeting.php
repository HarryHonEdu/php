<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $time = date("G");
        echo $time . "<br>";

        if ($time > 5 and $time < 11) 
        { echo "Good Morning!"; }
        else if ($time > 12 and $time < 17)
        { echo "Good Afternoon!"; }
        else if ($time > 18 and $time < 21)
        { echo "Good Evening!"; }
        else 
        { echo "Good Night!"; }
        
        ?>
    </body>
</html>
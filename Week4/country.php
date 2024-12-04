<!DOCTYPE html>
<html>
    <body>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="get">
            <label for="country">Choose a country:</label>
            <select name="country" id="country">
                <option value="Malaysia">Malaysia</option>
                <option value="Iraq">Iraq</option>
                <option value="Brunei">Brunei</option>
                <option value="Japan">Japan</option>
                <option value="South Korea">South Korea</option>
                <option value="Thailand">Thailand</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="Mexico">Mexico</option>
            </select>

            <br>

            <label for="day">Day:</label>
            <?php
                echo "<select name=day>";
                for ($i = 1; $i <= 31; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                echo "</select>";
                
            ?>
            <label for="month">Month:</label>
            <?php
                echo "<select name=month>";
                $month = array("January", "February", "March", 
                "April", "May", "June", "July",
                "August", "September", "October", "November", "December");
                for ($i = 0; $i <= 11; $i++) {
                    echo '<option value="' . $i + 1 . '">' . $month[$i] . '</option>';
                }
                echo "</select>";
               
            ?>
            <label for="year">Year:</label>
            <?php
                echo "<select name=year>";
                for ($i = 2000; $i <= 2024; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                echo "</select>";
            ?>
            <p>Please select your gender:</p>
            <input type="radio" id="gender1" name="gender" value="Male">
            <label for="gender1">Male</label>
            
            <br>

            <input type="radio" id="gender2" name="gender" value="Female">
            <label for="gender2">Female</label>
            
            <br>

            <input type="submit">

            <?php
            if (isset($_GET["country"]))
            {
                if(empty($_GET["country"]))
                {
                    echo "Please select your country.";
                } else {
                    echo "<br>";
                    echo "Your selected country is: " . $_GET["country"] . "<br>";
                }
                echo "Your selected DOB is: " 
                . $_GET["day"] . "/" 
                . $_GET["month"] . "/" 
                . $_GET["year"] . "<br>";
            }
            if (isset($_GET["gender"]))
                echo "Your selected gender is: " . $_GET["gender"];
            if (isset($_GET["year"]))
                $age = 2024 - $_GET["year"];
                if(!empty($_GET['year']))
                echo "<br> Your age is: " . $age;
            if (isset($_GET["month"]) && isset($_GET["day"]))
                $zodiac = "";
                if(!empty($_GET['month']) && !empty($_GET['day']))
                { 
                    $month = $_GET['month']; 
                    $day = $_GET['day']; 
                }
                if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
                    $zodiac = "Aquarius";
                } elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
                    $zodiac = "Pisces";
                } elseif (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
                    $zodiac = "Aries";
                } elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
                    $zodiac = "Taurus";
                } elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
                    $zodiac = "Gemini";
                } elseif (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) {
                    $zodiac = "Cancer";
                } elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
                    $zodiac = "Leo";
                } elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
                    $zodiac = "Virgo";
                } elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
                    $zodiac = "Libra";
                } elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
                    $zodiac = "Scorpio";
                } elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
                    $zodiac = "Sagittarius";
                } else {
                    $zodiac = "Capricorn";
                }
                echo " <br> Your Zodiac is: " . $zodiac;
            ?>
        </form>
    </body>
</html>
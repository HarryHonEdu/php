<?php
if (isset($_GET["name"]))
{
    if(empty($_GET["name"]))
    {
      echo "Please enter your name. <br>";
    }
    if(empty($_GET["email"]))
    {
      echo "Please enter your email. <br>";
    }
    if(empty($_GET["age"]))
    {
      echo "Please enter your age. <br>";
    }
} 
?>
<!DOCTYPE HTML>
<html>  
  <style>
    h4 {color: red;}
  </style>
  <body>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="get">
    Name: <input type="text"name="name"><br>
    E-mail: <input type="text"name="email"><br>
    Age: <input type="text"name="age"><br>
<input type="submit">
</form>
  <?php
  if(!(empty($_GET)))
  {
    echo "Welcome: " . $_GET["name"] . "<br>";

    $email = $_GET["email"];

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "Valid Email Address <br>";
    } else {
        echo "Invalid Email Address <br>";
    }

    $age = $_GET['age'];

    if (is_numeric($age) && $age >= 18 && $age <= 100) {
        echo "The age is valid. <br>" . "Your input is: " . $age;
    } else {
        echo "<h4>Invalid age. Please enter a number between 18 and 100.</h4> " . "Your input is: " . $age;
    }
  }
    
  ?>
  </body>
</html>

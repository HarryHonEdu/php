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
  <body>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="GET">
    Name: <input type="text"name="name"><br>
    E-mail: <input type="text"name="email"><br>
    Age: <input type="text"name="age"><br>
    <input type="submit">
    </form>

    
    Welcome <?php if(!empty($_GET)) echo $_GET["name"]; ?><br>
    Your Email: <?php if(!empty($_GET)) echo $_GET["email"]; ?><br>
    Age: <?php if(!empty($_GET)) echo $_GET["age"]; ?><br>
  </body>
</html>

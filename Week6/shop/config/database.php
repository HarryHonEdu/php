<?php
// used to connect to the database
$host = "localhost";
$db_name = "customers";
$username = "root";
$password = "";

//Error Handling
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    echo "Connected successfully"; 
} catch(PDOException $exception) {
    echo "Connection error: ".$exception->getMessage();
}
?>

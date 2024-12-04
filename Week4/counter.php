<?php
session_start();

if(isset($_SESSION['visitCount']))
{
    $_SESSION['visitCount'] ++;
} else {
    $_SESSION['visitCount'] = 1;
}

$visit_count = $_SESSION['visitCount'];
echo "<p>Welcome Back!</p>";
echo "<p>You have visited this page " . $visit_count . " times.</p>";
?>
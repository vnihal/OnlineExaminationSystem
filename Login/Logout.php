<?php


session_start();

if(session_destroy()) // Destroying All Sessions
{
    session_unset();
header("Location:Login.php"); // Redirecting To Home Page
}

?>


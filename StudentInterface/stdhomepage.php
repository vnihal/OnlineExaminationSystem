
<?php
//error_reporting(0);
//Student main page!
include 'StudentObje.php';
include 'menu.php';
session_start();
//include 'Login/logincheck.php';
//include './studentLoginControl.php';


$currentStudent = $_SESSION['currentStudent'];

?>
<html>
    <head>
        <title>OES-Main Screen</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body>
         <p align="left">Welcome <?php echo $currentStudent->getFirstName()." ".$currentStudent->getLastName()." (".$currentStudent->getPriviligeStatus().")"?>
    </body>
</html>

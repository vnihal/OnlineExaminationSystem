<?php
include 'insmenu.php';
include 'InstructorObject.php';
include 'inslogincheck.php';
include '../ConnectionDatabase.php';
session_start();

$currentInstructor = $_SESSION['currentInstructor'];

?>


<html>
    <head>
        <title>OES-Main Screen</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body>
        <p align="left">Welcome <?php echo $currentInstructor->getFirstName()." ".$currentInstructor->getLastName()." (".$currentInstructor->getPriviligeStatus().")"?></p>
    </body>
</html>
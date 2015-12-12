<?php
include 'TAmenu.php';
include 'TeachingAssistant.php';
//include 'inslogincheck.php';
include '../ConnectionDatabase.php';
session_start();

$currentTeachingAssistant = $_SESSION['currentTeachingAssistant'];

?>


<html>
    <head>
        <title>OES-Main Screen</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body>
        <p align="left">Welcome <?php echo $currentTeachingAssistant->getFirstName()." ".$currentTeachingAssistant->getLastName()." (".$currentTeachingAssistant->getPriviligeStatus().")"?></p>
    </body>
</html>
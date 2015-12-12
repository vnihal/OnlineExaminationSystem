<?php
    session_start();
  if(!(isset($_SESSION["instructor_login"]) && $_SESSION["instructor_login"] == "OK")) {
    header("Location: ../Login/Login.php");
    exit;
}
?>
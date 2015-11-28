<?php
  session_start();

  if(!(isset($_SESSION["student_login"]) && $_SESSION["student_login"] == "OK")) {
    header("Location: Login/Login.php");
    exit;
}
?>
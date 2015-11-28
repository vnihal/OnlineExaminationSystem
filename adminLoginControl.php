<?php
  session_start();

  if(!(isset($_SESSION["admın_login"]) && $_SESSION["admin_login"] == "OK")) {
   header("Location: Login/Login.php");
    exit;
}
?>
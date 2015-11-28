<?php

session_start(); // Starting Session
include ("../ConnectionDatabase.php");
$error=''; // Variable To Store Error Message
if (isset($_POST['Login'])) {
if (empty($_POST['userId']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['userId'];
$password=$_POST['password'];

// To protect MySQL injection for Security purpose
//$username = stripslashes($username);
//$password = stripslashes($password);
//$username = mysql_real_escape_string($username);
//$password = mysql_real_escape_string($password);

$query = mysql_query("select * from user where UserPassword='$password' AND UserId='$username'");
$previlege=mysql_fetch_array($query);
$rows = mysql_num_rows($query);
if ($rows!=0) {
    
$_SESSION['UserId']=$username; // Initializing Session

if($previlege['Previleged']==1){
header("location:../Admin.php"); // Redirecting To Other Page
$_SESSION['admin_login'] = "OK";
}
if($previlege['Previleged']==2){
    
}
if($previlege['Previleged']==3){
    
}
if ($previlege['Previleged']==4) {
    header("location:../Student.php");
    $_SESSION['student_login'] = "OK";
    
}
} 
else {
$error = "Username or Password is invalid";
header("location:Login.php");
}
//mysql_close($connection); // Closing Connection
}
}
?>

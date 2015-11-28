<?php

include 'ConnectionDatabase.php';
include ("./adminLoginControl.php");
//Define the query
$s=$_POST['UserId'];


$query = "DELETE FROM user WHERE UserId='$s' LIMIT 1 ";

//sends the query to delete the entry
mysql_query ($query);

if (mysql_affected_rows() == 1) { 
//if it updated
?>

            <strong>Contact Has Been Deleted</strong><br /><br />
          

<?php
 } else { 
//if it failed
?>

            <strong>Deletion Failed</strong><br /><br />


<?php
} 
  header("location: ViewUser.php");
?>
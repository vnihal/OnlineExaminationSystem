<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    
    <?php
include 'Admin.php';
include 'ConnectionDatabase.php';
//Define the query
$f=$_GET['UserId'];
$contacts = mysql_query("
                        SELECT * FROM user WHERE UserId='$f'") or die( mysql_error() );
 $selectedrow= mysql_fetch_array($contacts);
?>
<div>
    <h1>Edit User Information </h1> <br>
    
</div>



<form action="Update.php" method="post">
    <table class="table" border= "0" id="contact-list">
                        <thead>
                            
                            <input type="hidden" name="userid" value="<?php echo $selectedrow['UserId']; ?>">
                          <!-- <tr>
                                <td>User ID</td>
                                 
                                 <td><input type="text" name="userid" value="<?php echo $selectedrow['UserId']; ?>" /></td>
                            </tr>-->
                            <tr>
                                <td>First Name</td>
                                 
                                 <td><input type="text" name="firstname" value="<?php echo $selectedrow['FirstName']; ?>" /></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                 
                                 <td><input type="text" name="lastname" value="<?php echo $selectedrow['LastName']; ?>" /></td>
                            </tr>
                            
                            
                            
                            <tr>
                                <td>Email</td>
                                
                                 <td><input type="email" name="emaill" value="<?php echo $selectedrow['emaill']; ?> " />
                            </tr>
                            <tr>
                                <td>Telephone Number </td>
                                 
                                 <td><input type="text" name="telnum" value="<?php echo $selectedrow['TelNum']; ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td>Previleged</td>
                               
                                 <td><input type="text" name="previleged" value="<?php echo $selectedrow['Previleged']; ?>" /></td>
                            </tr>
                            
                            <td>
                              <input type="submit" name="button" id="8" value="SAVE" />
                            
                            <input type="button" onClick="location.href='ViewUser.php'" name="button" id="9" value="BACK" />
                            </td>
                        </thead>
</table>
                        
    
  
</form>



    <?php
    // put your code here
    ?>
</body>
</html>

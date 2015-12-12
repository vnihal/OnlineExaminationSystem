<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include './InstructorObject.php';
include './insmenu.php';
include './inslogincheck.php';
include '../ConnectionDatabase.php';
session_start();
//error_reporting(-1);

?>


<?php
$currentInstructor = $_SESSION['currentInstructor'];

if (!empty($_REQUEST['savem'])) {
    if($_REQUEST['password']!=$_REQUEST['repass']){
        $_GLOBALS['message'] = "Password Do Not Match!!";
    }else{
         $query = "update user set UserPassword='" . $_REQUEST['password'] . "' where UserId='" . $currentInstructor->getUserid() . "'";

        if (!mysql_query($query))
            $_GLOBALS['message'] = mysql_error();
        else
            $_GLOBALS['message'] = "Your Profile is Successfully Updated."; 
    }
}
?>

<html>
    <head>
        <title>OES-Edit Profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
       <!-- <link rel="stylesheet" type="text/css" href="../Media/css/login_form.css"/>-->
        <script type="text/javascript" src="../validate.js" ></script>
    </head>
    <body >

        <div id="container">

            <form id="editprofile" action="inschangepass.php" onsubmit="return validateChangePassForm()" method="post" >
                <div>
<?php
//Displays the saved information.
$userid=$currentInstructor->getUserid();
$result = mysql_query("select UserId from user where UserId='$userid'");

$r = mysql_fetch_array($result);
//editing components
    ?>
                         <div class="addform">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="baslik">Change Password</h3>
                <form role="form" action="" method="post">
                    <div class="form-group">
                       <!-- <strong>User ID</strong>
                        <strong size="16"><?php echo $r['UserId']; ?></strong>-->
                        <label>Password</label>
                        <input type="password" name="password" id="password" onkeyup="isalphanum(this)"class="form-control2"  />
                        <label>Repeat Password</label>
                        <input type="password" name="repass" id="repass" onkeyup="isalphanum(this)"class="form-control2"/>
                        <?php
if ($_GLOBALS['message']) {
    echo "<div class=\"message\">" . $_GLOBALS['message'] . "</div>";
}
?>
                        
                        
                        
                        <input type="submit" value="Save" name="savem" title="Save the changes"class="btn btn-danger"/>
                        
                    
                   
                           

                    </div>



                </form>




            </div>
        </div>
    </div>
    </body>
</html>
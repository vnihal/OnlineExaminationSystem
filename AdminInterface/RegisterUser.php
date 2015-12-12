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
    // put your code here
    include 'AdminHeader.php';
    include 'User.php';
    include 'Admin.php';
    include '../ConnectionDatabase.php';
    ?>
    
    <div class="addform">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="baslik">Register User</h3>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" name="userid" placeholder="User ID" class="form-control">
                        <label>Password</label>
                        <input type="text" name="password"  placeholder="Password" class="form-control">
                        <label>Email</label>
                        <input type="email" name="emaill" placeholder="Email" class="form-control">
                        <label>Telephone Number</label>
                        <input type="text" name="telnum" placeholder="Telephone Number"class="form-control">
                        <label>First Name</label>
                        <input type="text" name="firstname" placeholder="First Name" class="form-control">
                        <label>Last Name</label>
                        <input type="text" name="lastname" placeholder="Last Name" class="form-control">
                        <label>Previlege</label>
                        <select name="previleged" >
                        
                           
                           <option value="1">Admin</option>
                           <option value="2">Instructor</option>
                           <option value="3">Teaching Assistant</option>
                           <option value="4">Student</option>
                        
                        </select>
                        <input type="submit" name="button"  value="Submit" class="btn btn-danger">
                           

                    </div>



                </form>




            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['button'])){

$User=new User($_POST['userid'],$_POST['password']);

$User->setEmail($_POST['emaill']);
$User->setTelno($_POST['telnum']);
$User->setFirstname($_POST['firstname']);
$User->setLastname($_POST['lastname']);
$User->setPrivilege($_POST['previleged']);

Admin::addUser($User);

header("Location:UserList.php");
}



?>
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
    include 'AdminHeader.php';
    include 'Admin.php';
    include '../ConnectionDatabase.php';
   
    
    
    $userid=$_GET['UserId2'];
    $selectedrow= mysql_fetch_array(Admin::takeuserinfo($userid));
    
    //userlistteki edit butonun olduğu formdan o userın id sini getiriyor.
    
    
    ?>
    <div class="addform">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="baslik">Edit User</h3>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <!--<label>User ID</label>
                        <input type="text" name="userid" placeholder="User ID" class="form-control">-->
                         <input type="hidden" name="userid" class="form-control" value="<?php echo $selectedrow['UserId']; ?>" >
                        <label>Password</label>
                        <input type="text" name="password"  class="form-control" value="<?php echo $selectedrow['UserPassword']; ?>">
                        <label>Email</label>
                        <input type="email" name="emaill" class="form-control" value="<?php echo $selectedrow['emaill']; ?> " />
                        <label>Telephone Number</label>
                        <input type="text" name="telnum" class="form-control" value="<?php echo $selectedrow['TelNum']; ?>" />
                        <label>First Name</label>
                        <input type="text" name="firstname"class="form-control" value="<?php echo $selectedrow['FirstName']; ?>"/>
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $selectedrow['LastName']; ?>" />
                        <label>Previlege</label>
                        <input type="text" name="previleged" class="form-control" value="<?php echo $selectedrow['Privilege_id']; ?>" />
                        <input type="submit" name="button"  value="Edit" class="btn btn-danger">
                           

                    </div>



                </form>




            </div>
        </div>
    </div>
</body>
</html>
<?php

if(isset($_POST['button'])){
    
    Admin::updateUserInfo($_POST['userid'],$_POST['password'],$_POST['emaill'],$_POST['telnum'],$_POST['firstname'],$_POST['lastname'],$_POST['previleged']);
    
     header("Location:UserList.php");
    
    
}

if(isset($_POST['deletesubmit'])){
    
    $deleteduserid=$_POST['UserId1'];
    
   //Admin::deleteUser($deleteduserid);
    
    if (Admin::deleteUser($deleteduserid)!=-1){
    header("Location:UserList.php");
    }
    
    
}

?>
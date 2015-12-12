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
    
    ?>
    <div class="addform">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User List</h3>
                    </div>
                    <div class="panel-body1 panel-body-table">

                        <div class="table-responsive">
                            
                            <?php
 

                         $contacts=Admin::viewListOfUser(); 
                         if(mysql_num_rows( $contacts )==0)
                             echo 'There is no recorded user ';
                         
                    // If results ( mysql_num_rows( $contacts ) > 0 )
                         
                         else
                         ?>
                            
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width="50">ID</th>
                                        <th>First Name</th>
                                        <th width="100">Last Name</th>
                                        <th width="100">Email</th>
                                        <th width="100">Privileged</th>
                                        <th width="130">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while( $contact = mysql_fetch_array( $contacts ) ) : ?>
                                    
                                    <tr id="trow_1">
                                        <td class="text-center"><?php echo $contact['UserId'];?></td>
                                        <td class="text-center"><?php echo $contact['FirstName']; ?></td>
                                        <td class="text-center"><?php echo $contact['LastName'];?></td>
                                        <td class="text-center"><?php echo $contact['emaill']; ?></td>
                                        <td class="text-center"><?php echo $contact['Privilege_id']; ?></td>
                                        
                                        <td>
                                            <form action="EditUser.php" name="<?php echo $contact['UserId']; ?>" method="post">
                                             <input type="hidden" name="UserId1" value="<?php echo $contact['UserId']; ?>">
                                              <input type="submit" name="deletesubmit" class="btn btn-danger" value="Delete" >
                                             </form>
                                            <form action="EditUser.php" name="<?php echo $contact['UserId']; ?>" method="get">
                                           <input type="hidden" name="UserId2" value="<?php echo $contact['UserId']; ?>">
                                            <input type="submit" name="editsubmit" class="btn btnedit" value="Edit" >
                                           </form> 
        <!--    <button type="submit" class="btn btnedit">Edit</button>
        <button type="submit" class="btn btn-danger">Delete</button-->
                                        </td>

                                    </tr>
                                     <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!-- 

if(isset($_POST['deletesubmit'])){
    
    $deleteduserid=$_POST['UserId1'];
    
   //Admin::deleteUser($deleteduserid);
    
    if (Admin::deleteUser($deleteduserid)== 1){
    header("Location:UserList.php");
    }
    
    
}



-->
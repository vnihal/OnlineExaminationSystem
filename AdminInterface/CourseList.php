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
    include 'Admin.php';
    include '../ConnectionDatabase.php';
    ?>
    
    <div class="addform">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Course List</h3>
                    </div>
                    <div class="panel-body1 panel-body-table">

                        <div class="table-responsive">
                            
                            <?php
 

                         $contacts=Admin::viewListOfCourse(); 
                         if(mysql_num_rows( $contacts )==0)
                             echo 'There is no recorded course';
                         
                    // If results ( mysql_num_rows( $contacts ) > 0 )
                         
                         else
                         ?>
                            
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width="50">Course ID</th>
                                        <th>Course Name</th>
                                        <th width="100">Instructor ID</th>
                                        <th width="100">First Name</th>
                                        <th width="100">Last Name</th>
                                        <th width="130">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while( $contact = mysql_fetch_array( $contacts ) ) : ?>
                                    
                                    <tr id="trow_1">
                                        <td class="text-center"><?php echo $contact['courseid'];?></td>
                                        <td class="text-center"><?php echo $contact['coursename']; ?></td>
                                        <td class="text-center"><?php echo $contact['userid'];?></td>
                                        <td class="text-center"><?php echo $contact['FirstName']; ?></td>
                                        <td class="text-center"><?php echo $contact['LastName']; ?></td>
                                        
                                        <td>
                                            <form action="EditCourse.php" name="<?php echo $contact['courseid']; ?>" method="post">
                                             <input type="hidden" name="CourseId1" value="<?php echo $contact['courseid']; ?>">
                                              <input type="submit" name="deletesubmit" class="btn btn-danger" value="Delete" >
                                             </form>
                                            <form action="EditCourse.php" name="<?php echo $contact['courseid']; ?>" method="get">
                                           <input type="hidden" name="courseId2" value="<?php echo $contact['courseid']; ?>">
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

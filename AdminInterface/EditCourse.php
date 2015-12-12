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
    ob_start(); 
    include 'AdminHeader.php';
    include 'Admin.php';
    include '../ConnectionDatabase.php';
   
    
    
    $courseid=$_GET['courseId2'];
    $selectedrow= mysql_fetch_array(Admin::takecourseinfo($courseid));
    
    //userlistteki edit butonun olduğu formdan o userın id sini getiriyor.
    
    
    ?>
    <div class="addform">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="baslik">Edit Course</h3>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <!--<label>User ID</label>
                        <input type="text" name="userid" placeholder="User ID" class="form-control">-->
                         <input type="hidden" name="courseid" class="form-control" value="<?php echo $selectedrow['courseid']; ?>" >
                        <label>Course ID</label>
                        <input type="text" name="CourseID"  class="form-control" value="<?php echo $selectedrow['courseid']; ?>">
                        <label>Course Name</label>
                        <input type="text" name="coursename" class="form-control" value="<?php echo $selectedrow['coursename']; ?> " />
                        
                        <label>Instructor </label>
                        
                        <select name="belongstoid" >
                       <?php 
                       $query=  mysql_query("SELECT Userid,FirstName,LastName FROM user WHERE Privilege_id='2'");
                       while(  $array =  mysql_fetch_array($query) ) : ?>     
                           
                          <?php if($array['Userid']==$selectedrow['userid']){?>
                          <option selected="selected"  value="<?php echo $array['Userid']?>"><?php echo $array['FirstName']." ".$array['LastName'] ?></option>
                          <?php }  
                          else {
                              ?>
                          <option value="<?php echo $array['Userid']?>"><?php echo $array['FirstName']." ".$array['LastName'] ?></option>
                          <?php } ?>
                          
                          
                        <?php endwhile; ?>   
                        </select>
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
    
    Admin::updateCourseInfo($_POST['courseid'],$_POST['CourseID'],$_POST['coursename'],$_POST['belongstoid']);
    
    header("Location:CourseList.php");
    
    
}

if(isset($_POST['deletesubmit'])){
    
    $deletedcourseid=$_POST['CourseId1'];
    
   //Admin::deleteUser($deleteduserid);
    
    if (Admin::deleteCourse($deletedcourseid)!=-1){
    
        header("Location:CourseList.php");
    }
    
    
}
ob_end_flush();
?>
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
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="baslik">Add Course</h3>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label>Course ID</label>
                        <input type="text" name="courseid" placeholder="Course ID" class="form-control">
                        <label>Course Name</label>
                        <input type="text" name="coursename"  placeholder="Course name" class="form-control">
                        <label>Instructor</label>
                        
                        <?php
                        
                        $query=  mysql_query("SELECT Userid,FirstName,LastName FROM user WHERE Privilege_id='2'");
                        
                       // $array=  mysql_fetch_array($query);
                        
                        if(mysql_num_rows($query)==0){
                             echo 'There is no Instructor to open a course ';
                        }
                        
                        else
                        ?>                       
                        
                       <select name="belongstoid" >
                       <?php while(  $array =  mysql_fetch_array($query) ) : ?>     
                           
                           <option value="<?php echo $array['Userid']?>"><?php echo $array['FirstName']." ".$array['LastName'] ?></option>
                        
                        <?php endwhile; ?>   
                        </select>
                        <br>
                        <br>
                        <input type="submit" name="button1"  value="Submit" class="btn btn-danger">
                           

                    </div>



                </form>




            </div>
        </div>
    </div>
</body>
</html>

    <?php
if(isset($_POST['button1'])){
    
   //echo $_POST['belongstoid'];

Admin::addcourse($_POST['courseid'],$_POST['coursename'],$_POST['belongstoid']);

header("Location:CourseList.php");
}



?>
    
    

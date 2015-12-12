
<?php
//error_reporting(0);
//Student main page!
session_start();
//include 'Login/logincheck.php';
//include './studentLoginControl.php';
//include 'dbconnect.php';
include './menu.php';
include 'StudentObje.php';
include '../ConnectionDatabase.php'

//$connection = mysql_connect('localhost','root','');
//mysql_select_db('oesdatabase',$connection);
?>
<html>
    <head>
        <title>OES-Student Select Course</title>
        <link rel="stylesheet" type="text/css" href="../Media/css/style.css"/>
    </head>
    <body>

        <div id="container">
            
              
            <?php
if($_GLOBALS['message']) {
echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
}
?>
            <?php
           $query = "select course.courseid,coursename,count(course.courseid) as 'count' from course,exam where course.courseid=exam.courseid group by course.courseid";
            $resultSet = mysql_query($query);

            $num_rows = mysql_num_rows($resultSet);

            if ($num_rows > 0) {
                echo "<table id='mytable' class='table-hover table-bordered table-striped table col-xs-offset-1' align='center' ><tr><th>CourseID</th><th>Course Name</th><th>Exams</th><th>Action</th></tr>";
                while ($result = mysql_fetch_array($resultSet)) :
 
                    ?>
                   <tr class="col-xs-offset-1"align="center">
                       
                        <td class="contact-name"><?php echo $result['courseid']; ?></td>
                        <td class="contact-firstname"><?php echo $result['coursename']; ?></td>
                        <td class="contact-lastname"><?php echo $result['count']; ?></td>
                        <td> <form action='stdselectexam.php' name="<?php echo $result['courseid']; ?>" method="post">
                         <input type="hidden" name="selectedCourseId" value="<?php echo $result['courseid']; ?>">
                         <input type="submit" class="btn btn-danger btn-md" name="courseSelectButton" value="Select Course" >
                            </form> </td>  
                    </tr> 

                <?php
                endwhile;
                echo "</table>";
            }
            else {
                echo "No Courses Found!";
            }
            ?>

        </div>
    </body>
</html>

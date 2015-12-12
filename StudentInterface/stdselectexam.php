<?php
include './menu.php';
include '../ConnectionDatabase.php';
session_start();


$selectedCourseId = $_POST['selectedCourseId'];
      $query = "select courseid,examid,examname,Duration,examtype,StartDate,EndDate from exam where courseid='".$selectedCourseId."'";
 $resultSet = mysql_query($query);
 //echo $query;
 
 $num_rows = mysql_num_rows($resultSet);

            if ($num_rows > 0) {
                echo "<table class='table' ><tr><th>CourseID</th><th>Exam Name</th><th>Duration</th><th>Type</th><th>Start Date</th><th>End Date</th></tr>";
                while ($result = mysql_fetch_array($resultSet)) :
 
                    ?>
                   <tr align="center">
                        <td class="contact-name"><?php echo $result['courseid']; ?></td>
                        <td class="contact-firstname"><?php echo $result['examname']; ?></td>
                        <td class="contact-lastname"><?php echo $result['Duration']; ?></td>
                        <td class="contact-name"><?php echo $result['examtype']; ?></td>
                        <td class="contact-firstname"><?php echo $result['StartDate']; ?></td>
                        <td class="contact-lastname"><?php echo $result['EndDate']; ?></td>
                        <td> <form action='stdexam.php' name="<?php echo $result['examid']; ?>" method="post">
                                <input type="hidden" name="selectedExamId" value="<?php echo $result['examid']; ?>">
                                <input type="submit" class="btn btn-danger btn-md" name="examSelectButton" value="Select Exam" >
                            </form> </td>  
                    </tr> 
                <?php
                endwhile;
                echo "</table>";
            }
            else {
                echo "No Exams Found!";
            }
?>

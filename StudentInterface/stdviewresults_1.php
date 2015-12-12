<?php

/* 
 * This page is for students to view their exam results. It is connected with stdexam and StudentAnswers and exam table
 * in oesdatabase as the system compares the answers of the student with the pre-destined answers given by instructor.
 */
include './ConnectionDatabase.php';
include './menu.php';
include './StudentObje.php';

error_reporting(-1);
session_start();
$currentStudent = $_SESSION['currentStudent'];

$query = "SELECT course.courseid, course.coursename, exam.examname, student_has_exam.Score "
        . "FROM course,exam,student_has_exam "
        . "WHERE course.courseid=exam.courseid AND exam.examid=student_has_exam.exam_examid "
        . "AND student_has_exam.user_UserId='".$currentStudent->getUserid()."'";

$resultSet = mysql_query($query);
 
 $num_rows = mysql_num_rows($resultSet);

            if ($num_rows > 0) {
                echo "<table class='table' ><tr><th>CourseID</th><th>Course Name</th><th>Exam Name</th><th>Score</th></tr>";
                while ($result = mysql_fetch_array($resultSet)) :
 
                    ?>
                   <tr align="center">
                        <td class="contact-name"><?php echo $result['courseid']; ?></td>
                        <td class="contact-firstname"><?php echo $result['coursename']; ?></td>
                        <td class="contact-name"><?php echo $result['examname']; ?></td>
                        <td class="contact-name"><?php echo $result['Score']; ?></td>
                        
                    </tr> 

                <?php
                endwhile;
                echo "</table>";
            }
            else {
                echo "No Results Yet!";
            }
?>
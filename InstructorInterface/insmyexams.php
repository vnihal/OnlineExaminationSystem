<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'insmenu.php';
include '../ConnectionDatabase.php';
include 'InstructorObject.php';

$currentUserId = $_SESSION['UserId'];
?>

<?php
    if(isset($_REQUEST['examDeleteButton'])){
        $selectedExamID = $_POST['selectedExamId'];
              
        InstructorObject::deleteExam($selectedExamID);

// $query = "DELETE from exam where examid='$selectedExamID'";
        //mysql_query($query) or die (mysql_error());
    }

    if(isset($_REQUEST['editExam_saveButton'])){
        //$examName = addslashes($_POST['popup_examName']);
        //$examType = addslashes($_POST['popup_examTypeRadios']);
        $parts = explode('/', $_POST['popup_startDate']);
        $startDate = addslashes("$parts[2]-$parts[1]-$parts[0]"); // change date format to yyyy-mm-dd(for mysql)

        $parts = explode('/', $_POST['popup_endDate']);
        $endDate = addslashes("$parts[2]-$parts[1]-$parts[0]"); // change date format to yyyy-mm-dd(for mysql)
        //$secretCode = addslashes($_POST['popup_secretCode']);
        //$courseId = addslashes($_POST['popup_forCourse']);
       //$duration = addslashes($_POST['popup_duration']);
        //$examId = addslashes($_POST['popup_selectedExamId']);
                
        InstructorObject::UpdateExam(addslashes($_POST['popup_examName']),addslashes($_POST['popup_examTypeRadios']),addslashes($_POST['popup_forCourse']),$startDate,$endDate,addslashes($_POST['popup_duration']),addslashes($_POST['popup_secretCode']),addslashes($_POST['popup_selectedExamId']));
        //$completeSql = "UPDATE exam " . "SET examtype='$examType',examname='$examName',courseid='$courseId',StartDate='$startDate',EndDate='$endDate',Duration='$duration',secretcode='$secretCode' " .
          //      "WHERE examid='$examId';";
         //mysql_query($completeSql) or die (mysql_error());
         $_GLOBALS['message']="Edit completed successfully";
    }
    //$query = "SELECT exam.examid,examtype,examname,courseid,StartDate,EndDate,Duration,secretcode FROM exam,instructor_exam WHERE exam.examid=instructor_exam.examid AND UserId='".$currentUserId."'";
     //$resultSet = mysql_query($query) or die (mysql_error());
    
    $resultSet=InstructorObject::listExams($currentUserId);

            $num_rows = mysql_num_rows($resultSet);

            if ($num_rows > 0) {
                echo "<br><table id='mytable' class='table-hover table-bordered table-striped table col-xs-offset-1' align='center' ><tr><th>Course Id</th><th>Exam Name</th>"
                . "<th>Exam Type</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Secret Code</th><th>Operation</th></tr>";
                $counter = 0;
                while ($result = mysql_fetch_array($resultSet)) :
 
                    ?>
                   <tr class="col-xs-offset-1" align="left">
                        <td class="contact-name"><?php echo $result['courseid']; ?></td>
                        <td id="examName" class="contact-firstname" value="<?php echo $result['examname']; ?>"><?php echo $result['examname']; ?></td>
                        <td id="examType" class="contact-lastname" value="<?php echo $result['examtype']; ?>" ><?php echo $result['examtype']; ?></td>
                        <td id="startDate" class="contact-name" value="<?php echo $result['StartDate']; ?>" ><?php echo $result['StartDate']; ?></td>
                        <td id="endDate" class="contact-firstname" value="<?php echo $result['EndDate']; ?>" ><?php echo $result['EndDate']; ?></td>
                        <td id="durationSpinner" class="contact-lastname" value="<?php echo $result['Duration']; ?>"><?php echo $result['Duration']; ?></td>
                        <td id="secretCode" class="contact-lastname" value="<?php echo $result['secretcode']; ?>" ><?php echo $result['secretcode']; ?></td>
                        <td style="display:none;" value="<?php echo $result['examid']; ?>"><?php echo $result['examid']; ?></td>
                        <td> <form action='insmyexams.php' name="<?php echo $result['courseid']; ?>" method="post">
                        <input type="button" class="btn btn-success btn-md" name="examSelectButton" value="Add Question" ></input>
                        <!-- <input type="submit" class="btn-info" name="examSelectButton" value="Edit" > -->
                        
                        <button type="button" value="<?php echo $counter?>" id="examEditButton" class="btn btn-info btn-md" onclick="fillPopUpForm(this)" data-toggle="modal" data-target="#myPopUpModal">Edit</button>
                        <input type="hidden" value="<?php echo $result['examid']?>" name="selectedExamId" ></input>
                        <input type="submit" class="btn btn-danger btn-md" name="examDeleteButton" value="Delete" ></input>
                            </form> </td>
                            
                    </tr>

                <?php
                $counter++;
                endwhile;
                echo "</table>";
            }
            else {
                printf( "\nNo Courses Found!");
            }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../Media/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Media/css/jquery-ui.css">
       <!-- <link rel="stylesheet" href="../style.css">-->
        <script src="../Media/js/jquery-1.10.2.js"></script>
        <script src="../Media/js/jquery-ui.js"></script>
        <script src="../Media/js/validate.js"></script>
        <script src="../Media/js/bootstrap.min.js"></script>
        
    </head>
    <body>
         
        <!-- Modal -->
  <div class="modal fade" id="myPopUpModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Exam</h4>
        </div>
        <div class="modal-body">
            
          <form id="popup_editExamForm" class="form-horizontal" action="insmyexams.php" method="post">
                <div class="form-group">
                    <label class="control-label col-xs-2" for="popup_examName">Exam Name:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="popup_examName" id="popup_examName" placeholder="Exam Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2" for="popup_forCourse">For Course:</label>
                    <div class="col-xs-9">
                        <select id="popup_forCourse" name="popup_forCourse" class="form-control">
<?php
//$query = "SELECT course.courseid,coursename FROM course,courseinstructor WHERE course.courseid=courseinstructor.courseid AND userid='$currentUserId'";
$result = InstructorObject::listOfMycourses($currentUserId);
while ($row = mysql_fetch_array($result)) {
    echo "<option name='" . $row['courseid'] . "' value='" . $row['courseid'] . "'>" . $row['courseid'] . " - " . $row['coursename'] . "</option>";
}
?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2">Exam Type:</label>
                    <div class="col-xs-2">
                        <label class="radio-inline">
                            <input type="radio" id="popup_examTypeMultiple" name="popup_examTypeRadios" value="multipleChoice" checked> Multiple&nbsp;Choice
                        </label>
                    </div>
                    <div class="col-xs-2">
                        <label class="radio-inline">
                            <input type="radio" id="popup_examTypeEssay" name="popup_examTypeRadios" value="essay"> Essay
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2" for="popup_durationSpinner">Duration(mins):</label>
                    <div class="col-xs-2">
                        <input id="popup_durationSpinner" name="popup_duration" type="number" class="form-control" value="60" min="1" placeholder="minutes">
                        <div class="input-group-btn-vertical"></div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2">Exam Date:</label>
                    <div class="form-inline">
                        <div class="form-group"> <div class="col-xs-5">   <label class="text-primary col-xs-1"> Start&nbsp;Date:</label> </div></div>
                        <div class="form-group">  <div class="col-xs-2">   <input class="form-control" type="text" id="popup_from" name="popup_startDate" required> </div></div>                      

                        <div class="form-group"> <div class="col-xs-2">   <label class="text-primary col-xs-1"> End&nbsp;Date:</label> </div></div>
                        <div class="form-group">  <div class="col-xs-2">    <input class="form-control" type="text" id="popup_to" name="popup_endDate" required> </div></div>
                    </div>        
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2" for="popup_secretCode">Secret Code For Exam:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="popup_secretCode" name="popup_secretCode" placeholder="Secret code for students to take exam." required>
                         <input id="popup_selectedExamId" class="contact-lastname" name="popup_selectedExamId" value="" type="hidden"></td>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
               <input type="hidden" name="selectedExamId" value="
                   <?php
$query = "SELECT course.courseid,coursename FROM course,courseinstructor WHERE course.courseid=courseinstructor.courseid AND userid='$currentUserId'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    echo "<option name='" . $row['courseid'] . "' value='" . $row['courseid'] . "'>" . $row['courseid'] . " - " . $row['coursename'] . "</option>";
} ?>">
           <button type="submit" form="popup_editExamForm" id="editExam_saveButton" name="editExam_saveButton" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
            </form>
          
        </div>
        
      </div>
    </div>
  </div>
       
    </body>
</html>

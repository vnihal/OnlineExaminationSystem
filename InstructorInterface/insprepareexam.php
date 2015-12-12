<?php
include 'insmenu.php';
include '../ConnectionDatabase.php';
include 'inslogincheck.php';


$userId = $_SESSION['UserId'];
?>

<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
         
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../Media/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Media/css/jquery-ui.css">
      <!--  <link rel="stylesheet" href="../style.css">-->
        
        <script src="../Media/js/jquery-1.10.2.js"></script>
        <script src="../Media/js/jquery-ui.js"></script>
        
    </head>


    <?php
    if (isset($_POST['submit'])) {

        $examName = addslashes($_POST['examName']);
        $examType = addslashes($_POST['examTypeRadios']);
        $parts = explode('/', $_POST['startDate']);
        $startDate = addslashes("$parts[2]-$parts[1]-$parts[0]"); // change date format to yyyy-mm-dd(for mysql)

        $parts = explode('/', $_POST['endDate']);
        $endDate = addslashes("$parts[2]-$parts[1]-$parts[0]"); // change date format to yyyy-mm-dd(for mysql)
        $secretCode = addslashes($_POST['secretCode']);
        $courseId = addslashes($_POST['forCourse']);
        $duration = addslashes($_POST['duration']);
        


        $completeSql = "BEGIN;";
        mysql_query($completeSql) or die (mysql_error());
        $completeSql = "INSERT INTO exam " . "(examtype,examname,courseid,StartDate,EndDate,Duration,secretcode) " .
                "VALUES('$examType','$examName','$courseId','$startDate','$endDate','$duration','$secretCode');";
         mysql_query($completeSql) or die (mysql_error());
        $completeSql = "INSERT INTO instructor_exam " . "(userid,examid,status,isReviewed) " .
                "VALUES('$userId',LAST_INSERT_ID(),'active','0');";
         mysql_query($completeSql) or die (mysql_error());
        $completeSql = "COMMIT;";
         mysql_query($completeSql) or die (mysql_error());
       // echo "\n" . $completeSql . "\n";
         header("location:./insmyexams.php");

//   $previous_sql = "INSERT INTO exam " . "(examtype,examname, courseid, StartDate,EndDate,Duration,secretcode) " . "VALUES('$examType','$examName','$courseId','$startDate','$endDate','$duration','$secretCode') ";
        //  $nextsql = "INSERT INTO instructor_exam ". "(userid,courseid, status, isReviewed) VALUES('$userId',LAST_INSERT_ID(),'active','0'); ";

      //  $retval = mysql_query($completeSql);
      //  mysql_multi_query($completeSql);
      //  mysqli_begin_transaction();
      //  mysqli
        //   mysqli_query($completeSql);
        //     if(! $retval )
        //    {
        //      die('Could not enter data: ' . mysql_error());
        //  }
        //  else{
        //    echo "Entered data successfully\n";
        // }
    }
    ?>



    <body>
        <div class="container">
            <h1 class="h2">New Exam Form</h1><br>
            <form class="form-horizontal" action="insprepareexam.php" method="post">
                <div class="form-group">
                    <label class="control-label col-xs-2" for="examName">Exam Name:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="examName" id="examName" placeholder="Exam Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2" for="inputPassword">For Course:</label>
                    <div class="col-xs-9">
                        <select name="forCourse">
<?php
$query = "SELECT course.courseid,coursename FROM course,courseinstructor WHERE course.courseid=courseinstructor.courseid AND userid='$userId'";
$result = mysql_query($query);
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
                            <input type="radio" name="examTypeRadios" value="multipleChoice" checked> Multiple&nbsp;Choice
                        </label>
                    </div>
                    <div class="col-xs-2">
                        <label class="radio-inline">
                            <input type="radio" name="examTypeRadios" value="essay"> Essay
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2" for="durationSpinner">Duration(mins):</label>
                    <div class="col-xs-2">
                        <input id="durationSpinner" name="duration" type="number" class="form-control" value="60" min="1" placeholder="minutes">
                        <div class="input-group-btn-vertical"></div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2">Exam Date:</label>
                    <div class="form-inline">
                        <div class="form-group"> <div class="col-xs-5">   <label class="text-primary col-xs-1"> Start&nbsp;Date:</label> </div></div>
                        <div class="form-group">  <div class="col-xs-2">   <input class="form-control" type="text" id="from" name="startDate" required> </div></div>                      

                        <div class="form-group"> <div class="col-xs-2">   <label class="text-primary col-xs-1"> End&nbsp;Date:</label> </div></div>
                        <div class="form-group">  <div class="col-xs-2">    <input class="form-control" type="text" id="to" name="endDate" required> </div></div>
                    </div>        
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2" for="phoneNumber">Secret Code For Exam:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="secretCode" id="secretCode" placeholder="Secret code for students to take exam." required>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-9">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                </div>
            </form>
        </div>


    </body>
</html>

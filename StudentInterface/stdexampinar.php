<?php
include './StudentObje.php';
include '../ConnectionDatabase.php';
include './menu.php';
session_start();

$endOfExam = false;
$currentStudent = $_SESSION['currentStudent'];
if (isset($_SESSION['questionPointer'])) {
    $questionPointer = $_SESSION['questionPointer'];
} else{
    $questionPointer = 0;
    $_SESSION['questionPointer'] = $questionPointer;
}

if (isset($_POST['selectedExamId'])) {
    $_SESSION['selectedExamId'] = $_POST['selectedExamId'];
}
$selectedExamID = $_SESSION['selectedExamId'];

$studentAnsQuery = "SELECT studentanswers.studentgivenanswer, studentanswers.answerstatus "
        . "FROM studentanswers, question "
        . "WHERE question.Questionid = studentanswers.question_Questionid AND "
        . "question.exam_Examid=studentanswers.question_exam_Examid AND "
        . "studentanswers.user_UserId='" . $currentStudent->getUserid() . "'";
$questionQuery = "select * from question where exam_Examid='" . $selectedExamID . "'";
$countQuestions = "select count(question.Questionid) from question where exam_Examid='" . $selectedExamID . "'";
$questionTextQuery = "select question.Description from question where question.exam_Examid='" . $selectedExamID
        . "'";
echo $studentAnsQuery . "<br>";
echo $questionQuery . "<br>";
echo $countQuestions . "<br>";

$result1 = mysql_query($studentAnsQuery);
$stuAns = mysql_fetch_array($result1); //answerstatus and student's given answer 
$result2 = mysql_query($questionQuery);
$questions = mysql_fetch_array($result2); //question array for all question variables
$result3 = mysql_query($countQuestions);
$totalQuestions = mysql_fetch_array($result3); //for number of questions in exam
$result4 = mysql_query($questionTextQuery);
//$quesDesc = mysqli_fetch_all($result4,MYSQLI_BOTH); //for question description
//$array = array_values($quesDesc);
echo "Question count: " . $totalQuestions[0] . "<br>";
echo "Num rows: " . mysql_num_rows($result4);

if (!isset($_SESSION['Description'])) {

    $questionsArray = array();
    while ($row = mysql_fetch_array($result4)) {
        array_push($questionsArray, $row['Description']);
    }
    $_SESSION['Description'] = $questionsArray[0];
}

$questionPointer_value = (int) $questionPointer;
$totalQuestions_value = (int) $totalQuestions[0];
echo "Question Pointer: " . $questionPointer . "<br>";
echo "Total Question count: " . $totalQuestions_value . "<br>";
echo "QuestionPointer_value: " . $questionPointer_value . "<br>";
//echo "Curr. Ques. Desc.-1= ".$questionsArray[0];
//echo "Curr. Ques. Desc.-2= ".$questionsArray[1];
//echo "Curr. Ques. Desc.-3= ".$questionsArray[2];
//echo "Curr. Ques. Desc.-4= ".$questionsArray[3];

if (isset($_REQUEST['next'])){   //next question
    //echo "next basÄ±ldÄ±<br>";
    //echo "Q pointer: ".$questionPointer_value."<br>";
    //echo "Total Q count: ".$totalQuestions_value."<br>";
    if ($questionPointer_value < $totalQuestions_value) {//count questions until end of exam
        // $_SESSION['question']=$_SESSION['question']+1;
        echo "ifin ici<br>";
        //  echo $quesDesc['Description'][$questionPointer_value];
        //  echo $quesDesc[$questionPointer_value]['Description'];
        // $quesDesc[$questionPointer]=$quesDesc[$questionPointer+1];
        $questionPointer_value = $questionPointer_value + 1;
        $_SESSION['questionPointer'] = $questionPointer_value;
        $_SESSION['Description'] = $questionsArray[$questionPointer_value];
    } elseif ($questionPointer_value == $totalQuestions_value) {//end of exam
        $endOfExam = true;
    }
} //next 
else if (isset($_REQUEST['previous'])) {   //previous question
    //echo "Q pointer: ".$questionPointer_value."<br>";
    // echo "prev basÄ±ldÄ±<br>";
    if ($questionPointer_value > 0) {
        $questionPointer_value = $questionPointer_value - 1;
        $_SESSION['questionPointer'] = $questionPointer_value;
        $_SESSION['Description'] = $questionsArray[$questionPointer_value];
    }
}//previous
?>
<html>
    <head>
        <title>OES-Student Exam</title>
    </head>
    <body>
        <div id="container">
            <form action="stdexam.php" method="post">
                <table border="0" width="100%">
                    <tr>
                        <th><h4>Question No: <?php echo $questionPointer + 1; ?> </h4></th>
                    <th><h4><input type="checkbox" name="markreview" value="mark"> Mark For Review </input></h4></th>
                    </tr>
                </table>
                <textarea cols="100" rows="8" name="question"><?php echo $_SESSION['Description']; ?></textarea>
                <table border="0" width="100%">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td >1. <input type="radio" name="answer" value="OptA"> <?php echo $questions['OptA']; ?></input></td>
                    </tr>
                    <tr>
                        <td >2. <input type="radio" name="answer" value="OptB"> <?php echo $questions['OptB']; ?></input></td>
                    </tr>
                    <tr>
                        <td >3. <input type="radio" name="answer" value="OptC"> <?php echo $questions['OptC']; ?></input></td>
                    </tr>
                    <tr>
                        <td >4. <input type="radio" name="answer" value="OptD"> <?php echo $questions['OptD']; ?></input></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td></tr>
                    <tr>
                        <th><h4><input type="submit" name="next" id="next" value="Next"/></h4></th>
                    <th><h4><input type="submit" name="previous" value="Previous"/></h4></th>
                    <th><h4><a href="stdreview.php">Review Questions</a></h4></th>
                    </tr>
                </table>
<?php
/*
  if(isset($_POST['next']) && !empty($_POST['answer'])){
  $answer=$_POST['answer'];
  $insert_sql = mysql_query("INSERT INTO `studentanswers`(`user_UserId`, `question_Questionid`, `question_exam_Examid`,"
  . " `studentgivenanswer`, `answerstatus`) "."VALUES ('".$currentStudent->getUserid()."',[value-2],[value-3],[value-4],[value-5]");
  } */
?>

            </form>
        </div>
    </body>
</html>

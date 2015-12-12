
<?php
include '../QuestionObject.php';
include './StudentObje.php';

include './menu.php';
include '../ConnectionDatabase.php';
error_reporting(-1);
session_start();
$currentStudent = $_SESSION['currentStudent'];
$currentUserID = $_SESSION['UserId'];
$endOfExam = false;
?>

<?php
header("Cache-Control: no-cache, must-revalidate");

if (isset($_POST['selectedExamId'])) { // first request to this page
    $_SESSION['selectedExamId'] = $_POST['selectedExamId'];
    $_SESSION['questionPointer'] = 0;

    $questions_query = "SELECT * FROM question WHERE exam_Examid='" . $_SESSION['selectedExamId'] . "'";
    $countQuestions_query = "SELECT count(question.Questionid) FROM question WHERE exam_Examid='".$_SESSION['selectedExamId']."'";
    $resultSet = mysql_query($countQuestions_query) or die();
    $totalQuestionCount = mysql_fetch_array($resultSet)[0];
    $_SESSION['totalQuestionCount'] = $totalQuestionCount;
    $resultSet = mysql_query($questions_query);

    $questionsArray = array();
    while ($row = mysql_fetch_array($resultSet)) {
        $myNewQuestion = new QuestionObject();
        $myNewQuestion->setQuestionId($row['Questionid']);
        $myNewQuestion->setExamId('exam_Examid');
        $myNewQuestion->setDescription($row['Description']);
        $myNewQuestion->setMark($row['Mark']);
        $myNewQuestion->setCorrect($row['Correct']);
        $myNewQuestion->setOptA($row['OptA']);
        $myNewQuestion->setOptB($row['OptB']);
        $myNewQuestion->setOptC($row['OptC']);
        $myNewQuestion->setOptD($row['OptD']);
        array_push($questionsArray, $myNewQuestion);
        
        $studentAnswers_insertAll_query = "INSERT INTO studentanswers "
                . "(`user_UserId`, `question_Questionid`, `question_exam_Examid`, `studentgivenanswer`, `answerstatus`) "
                . "VALUES ('$currentUserID', '".$row['Questionid']."', '".$_SESSION['selectedExamId']."', NULL, 'unanswered');";
    
        mysql_query($studentAnswers_insertAll_query);
    }
    
    $_SESSION['questionsArray'] = $questionsArray;
    unset($_POST['selectedExamId']);
} else {   // later requests than the first one
    
    if (isset($_REQUEST['next'])){
               
       $answerstatus='unanswered';

        if(isset($_REQUEST['passquestion']))
            {
                $answerstatus='passed';
            }//passquestion
        else if(isset($_REQUEST['answer']))
            {
                $answerstatus='answered';
            }//answer
        else
            {
                $answerstatus='unanswered';
            }//unanswered
            
        if($answerstatus=="unanswered")
            {
            //sıkıntı burada
            echo "update et";
            
                if($answerstatus=="answered")
                {
                    
                    $query="";
                           // . "update studentanswers set answerstatus='answered',studentgivenanswer='".$_REQUEST['answer']."' where user_UserId=".$currentUserID." and question_exam_Examid=".$_SESSION['selectedExamId']." and question_Questionid=".$_SESSION['questionsArray'][$_SESSION['questionPointer']]->getQuestionId.";";
                }
                else
                {
                    $query="";
                            //. "update studentanswers set answerstatus='passed',studentgivenanswer='".$_REQUEST['answer']."' where user_UserId=".$currentUserID." and question_exam_Examid=".$_SESSION['selectedExamId']." and question_Questionid=".$_SESSION['questionsArray'][$_SESSION['questionPointer']]->getQuestionId.";";
                }
                if(!mysql_query($query))
                {
                // query'ler calismiyorsa
                 echo "Your previous answer is not updated.Please answer once again";
                }
            }
              
        if($_SESSION['questionPointer']<$_SESSION['totalQuestionCount']-1){
            $_SESSION['questionPointer'] = $_SESSION['questionPointer'] +1;
        }//next
        if ($_SESSION['questionPointer']==$_SESSION['totalQuestionCount']-1) {
            $endOfExam=true;
            
        }//submitexam
    
        
    }//end next or submitexam
    else if (isset($_REQUEST['previous'])) { 

        $answerstatus='unanswered';

        if(isset($_REQUEST['passquestion']))
            {
                $answerstatus='passed';
            }//passquestion
        else if(isset($_REQUEST['answer']))
            {
                $answerstatus='answered';
            }//answer
        else
            {
                $answerstatus='unanswered';
            }//unanswered
            
        if($answerstatus=="unanswered")
            {
                if($answerstatus=="answered")
                {
                    $query="update studentanswers set answerstatus='answered',studentgivenanswer='".$_REQUEST['answer']."' where user_UserId=".$currentUserID." and question_exam_Examid=".$_SESSION['selectedExamId']." and question_Questionid=".$_SESSION['questionsArray'][$_SESSION['questionPointer']]->getQuestionId.";";
                }
                else
                {
                    $query="update studentanswers set answerstatus='passed',studentgivenanswer='".$_REQUEST['answer']."' where user_UserId=".$currentUserID." and question_exam_Examid=".$_SESSION['selectedExamId']." and question_Questionid=".$_SESSION['questionsArray'][$_SESSION['questionPointer']]->getQuestionId.";";
                }
                if(!mysql_query($query))
                {
                // to do
                 echo "Your previous answer is not updated.Please answer once again";
                }
            }

        if($_SESSION['questionPointer']>=1){
            $_SESSION['questionPointer'] = $_SESSION['questionPointer'] -1;
        }
    }//end previous
    
    else if(isset($_REQUEST['submitexam']))
            {
                 header('Location: examack.php');
            }//submitexam
}

$studentAnsQuery = "SELECT studentanswers.studentgivenanswer, studentanswers.answerstatus "
        . "FROM studentanswers, question "
        . "WHERE question.Questionid = studentanswers.question_Questionid AND "
        . "question.exam_Examid=studentanswers.question_exam_Examid AND "
        . "studentanswers.user_UserId='" . $currentUserID . "'";
$resultSet= mysql_query($studentAnsQuery);
$stdAns=  mysql_fetch_array($resultSet);
?>


<html>
    <head>
        <title>OES-Student Exam</title>

        <link rel="stylesheet" type="text/css" href="../style.css"/>

    </head>
    <body> 
        
        <div id="container">
            <form id="examForm" action="stdexam.php" method="post">
                <div>
                    
                    <div>
                        <table border="0" width="100%">
                            <tr>
                                <th><h4>Question No: <?php echo $_SESSION['questionPointer']+1 ?> </h4></th>
                            <th><h4><input type="checkbox" name="passquestion" value="pass"> Pass Question </input></h4></th>
                            </tr>
                        </table>
                        <textarea cols="100" rows="8" name="question"><?php echo $_SESSION['questionsArray'][$_SESSION['questionPointer']]->getDescription(); ?></textarea>
                        <table border="0" width="100%">
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td >A) <input type="radio" name="answer" value="OptA"
                                    <?php 
                                    if(($stdAns['answerstatus']=="passed") || (($stdAns['answerstatus']=="answered") && ($stdAns['studentgivenanswer']=="OptA") )){
                                        echo "checked";
                                    }?>><?php echo $_SESSION['questionsArray'][$_SESSION['questionPointer']]->getOptA(); ?></input></td>
                            </tr>
                            <tr>
                                <td >B) <input type="radio" name="answer" value="OptB"
                                                <?php 
                                    if(($stdAns['answerstatus']=="passed") || (($stdAns['answerstatus']=="answered") && ($stdAns['studentgivenanswer']=="OptB") )){
                                        echo "checked";
                                    }?>><?php echo $_SESSION['questionsArray'][$_SESSION['questionPointer']]->getOptB(); ?></input></td>
                            </tr>
                            <tr>
                                <td >C) <input type="radio" name="answer" value="OptC"
                                            <?php 
                                    if(($stdAns['answerstatus']=="passed") || (($stdAns['answerstatus']=="answered") && ($stdAns['studentgivenanswer']=="OptC") )){
                                        echo "checked";
                                    }?>><?php echo $_SESSION['questionsArray'][$_SESSION['questionPointer']]->getOptC(); ?></input></td>
                        
                            </tr>
                            <tr>
                                <td >D) <input type="radio" name="answer" value="OptD"
                                                <?php 
                                    if(($stdAns['answerstatus']=="passed") || (($stdAns['answerstatus']=="answered") && ($stdAns['studentgivenanswer']=="OptD") )){
                                        echo "checked";
                                    }?>><?php echo $_SESSION['questionsArray'][$_SESSION['questionPointer']]->getOptD(); ?></input></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td></tr>
                            <tr>
                            <th><h4><input type="submit" name="previous" value="Previous"/></h4></th>
                            <th><h4><input type="submit" name="<?php if($endOfExam==true){ echo "submitexam" ;}else{ echo "next";} ?>" value="<?php if($endOfExam==true){ echo "Submit Exam" ;}else{ echo "Next";} ?>" class="subbtn"/></h4></th>
                            
                            <th><h4><a href="stdreview.php">Review Passed Questions</a></h4></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>


<?php
include './insmenu.php';
include '../ConnectionDatabase.php';
session_start();
$currentUserId = $_SESSION['UserId'];
$selectedExamID = $_SESSION['selectedExamId'];
?>
<?php

if(isset($_REQUEST['questionDeleteButton'])){
        $selectedQuestionID = $_POST['selectedQuestionId'];
        $query = "DELETE from question where Questionid='$selectedQuestionID' AND question.exam_Examid='$selectedExamID'";
        mysql_query($query) or die (mysql_error());
    }
    
    if(isset($_REQUEST['popup_editQuestionSaveButton'])){
        echo "butona basıldı<br>";
        $questionText = addslashes($_POST['popup_questionText']);
        $choiceA = addslashes($_POST['popup_OptionA_text']);
        $choiceB = addslashes($_POST['popup_OptionB_text']);
        $choiceC = addslashes($_POST['popup_OptionC_text']);
        $choiceD = addslashes($_POST['popup_OptionD_text']);
        $questionMark = addslashes($_POST['popup_questionMark']);
        $correctOption = addslashes($_POST['popup_optionRadios']);
        $questionId = addslashes($_POST['popup_selectedQuestionId']);

        $completeSql = "UPDATE question " . "SET Description='$questionText',OptA='$choiceA',OptB='$choiceB',OptC='$choiceC',OptD='$choiceD',Mark='$questionMark',Correct='$correctOption' " .
                "WHERE Questionid='$questionId';";
        echo $completeSql."<br>";
         mysql_query($completeSql) or die (mysql_error());
         $_GLOBALS['message']="Edit completed successfully";
    }
    
    if (isset($_REQUEST['popup_addQuestionSaveButton'])) {

        $questionText = addslashes($_POST['popup_questionText']);
        $choiceA = addslashes($_POST['popup_OptionA_text']);
        $choiceB = addslashes($_POST['popup_OptionB_text']);
        $choiceC = addslashes($_POST['popup_OptionC_text']);
        $choiceD = addslashes($_POST['popup_OptionD_text']);
        $questionMark = addslashes($_POST['popup_questionMark']);
        $correctOption = addslashes($_POST['popup_optionRadios']);
        $questionId = addslashes($_POST['popup_selectedQuestionId']);
        


  
        $completeSql = "INSERT INTO question " . "(Description,Mark,Correct,exam_Examid,OptA,OptB,OptC,OptD) " .
                "VALUES('$questionText','$questionMark','$correctOption','$selectedExamID','$choiceA','$choiceB','$choiceC','$choiceD');";
        echo $completeSql."<br>";
         mysql_query($completeSql) or die (mysql_error());
       // echo "\n" . $completeSql . "\n";


    }

$questionQuery = "select * from question where exam_Examid='" . $selectedExamID . "' order by Questionid ";
$resultSet = mysql_query($questionQuery);
$num_rows = mysql_num_rows($resultSet);


if ($num_rows > 0) {
    $query = "select * from exam where examid='$selectedExamID'";
    $r=mysql_query($query);
    $row = mysql_fetch_array($r);
    
    echo "<h3>". $row['courseid']." - ". $row['examname'] ." Exam Questions";
    echo "<div class='center-block' ><table id='examQuestionsTable' class='table table-condensed ' ><thead style='text-align: center' ;><th>Question Description</th><th>OptionA</th><th>OptionB</th><th>OptionC</th><th>OptionD</th><th>Correct Option</th><th>Mark</th><th>Action</th></thead>";
    $rowCounter = 0;
    while ($result = mysql_fetch_array($resultSet)) :
        ?>
        <tr style="display: table-row"> 
            <td style="display:table-column" class="contact-firstname"><?php echo $result['Description']; ?></td>
            <td class="contact-name"><?php echo $result['OptA']; ?></td>
            <td class="contact-firstname"><?php echo $result['OptB']; ?></td>
            <td class="contact-lastname"><?php echo $result['OptC']; ?></td>
            <td class="contact-name"><?php echo $result['OptD']; ?></td>
            <td class="contact-name"><?php echo $result['Correct']; ?></td>
            <td class="contact-name"><?php echo $result['Mark']; ?></td>
            <td style="display:none;" value="<?php echo $result['Questionid']; ?>"><?php echo $result['Questionid']; ?></td>
            <td> 
                <form action='insmanagequestions.php' name="<?php $result['Questionid'] ?>" method="post">
                    <button type="button" value="<?php echo $rowCounter++ ?>" id="questionEditButton" name="questionEditButton" class="btn btn-info btn-md" onclick="fillQuestionPopUpForm(this)" data-toggle="modal" data-target="#question_popUp">Edit</button>
                    <input type="hidden" value="<?php echo $result['Questionid'] ?>" name="selectedQuestionId" ></input>
                    <input type="submit" class="btn btn-danger btn-md" name="questionDeleteButton" value="Delete" ></input>
                </form> </td>
        </tr> 
        <?php
    endwhile;
    echo "</table></div>";
    ?>
    <form action='insmanagequestions.php' name="<?php echo $selectedExamID; ?>" method="post">
        <div class="center-block" align="center">
            <button type="button" value="" id="addQuestionButton" class="btn btn-success btn-md" onclick="addQuestionOnClick()" data-toggle="modal" data-target="#question_popUp">Add Question</button>
        </div>

    </form>
    <?php
}
else {
    echo "No Questions Found!";
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

        <div class="modal fade" id="question_popUp" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Exam</h4>
                    </div>
                    <div class="modal-body">
                        <form id="popup_addQuestionForm" class="form-horizontal" action="insmanagequestions.php" method="post">
                            <div class="form-group">
                                <label class="control-label col-xs-2" for="popup_questionText">Question Text:</label>
                                <div class="col-xs-9">
                                    <textarea type="text" rows="3" class="form-control" name="popup_questionText" id="popup_questionText" placeholder="Question Description" required></textarea>
                                </div>
                            </div>
                            
                                                
                            <div class="form-group">
                                <label class="control-label col-xs-2" for="popup_OptionA_text">Option A: </label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="popup_OptionA_text" id="popup_OptionA_text" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-xs-2" for="popup_OptionB_text">Option B: </label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="popup_OptionB_text" id="popup_OptionB_text"  required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-xs-2" for="popup_OptionC_text">Option C: </label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="popup_OptionC_text" id="popup_OptionC_text" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-xs-2" for="popup_OptionD_text">Option D: </label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="popup_OptionD_text" id="popup_OptionD_text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-2">Correct Option:</label>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" id="popup_correctChoiceA" name="popup_optionRadios" value="A" checked> A:
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" id="popup_correctChoiceB" name="popup_optionRadios" value="B" checked> B:
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" id="popup_correctChoiceC" name="popup_optionRadios" value="C" checked> C:
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" id="popup_correctChoiceD" name="popup_optionRadios" value="D"> D:
                                    </label>
                                </div>
                            </div>
                            
                                    <div class="form-group">
                                <label class="control-label col-xs-2" for="popup_questionMarkSpinner">Mark(points):</label>
                                <div class="col-xs-2">
                                    <input id="popup_questionMarkSpinner" name="popup_questionMark" type="number" class="form-control" value="10" min="1" max="100">
                                    <div class="input-group-btn-vertical"></div>

                                </div>
                            </div>
                            
                            <br>
                            <div class="modal-footer">
                                <input id="popup_selectedQuestionId" class="contact-lastname" name="popup_selectedQuestionId" value="" type="hidden">
                                <button type="submit" form="popup_addQuestionForm" id="popup_SaveButton" name="popup_addQuestionSaveButton" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
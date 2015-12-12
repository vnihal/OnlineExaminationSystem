<?php

include_once '../AdminInterface/User.php';

class StudentObje  extends User{ 
    
    var $StudentCourses = array();
    var $stdexamlist = array();

  public function getCourses() {
        $query = "SELECT * from course";
        $resultSet = executeQuery($query);
        return $resultSet;
        }
    
    function getExamList($userid, $courseid) {
        $query = mysql_query("") or die(mysql_error());
        //database'e gore degisecek
        while ($res = mysql_fetch_array($query)) {

            $stdexamlist[] = $res['courseid'];
        }
        return $stdexamlist;
    }
    
    public function getCourseExams(){
        $query = "select course.courseid,coursename,count(course.courseid) as 'count' from course,exam where course.courseid=exam.courseid group by course.courseid";
        $resultSet = executeQuery($query);
        return $resultSet;
    }
    
    function method_deneme() {
        
        if(isset($_REQUEST['next']) || isset($_REQUEST['summary']) || isset($_REQUEST['viewsummary']))
    {
        //next question
        $answerStatus='unanswered';
        if(time()<strtotime($_SESSION['endtime']))
        {
            
            if(strcmp($answerStatus,"unanswered")!=0)
            {
                if(strcmp($answerStatus,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                if(!executeQuery($query))
                {
                // to do
                $_GLOBALS['message']="Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
        }
        if((int)$_SESSION['qn']<(int)$_SESSION['tqn'])
        {
        $_SESSION['qn']=$_SESSION['qn']+1;
        }
        if((int)$_SESSION['qn']==(int)$_SESSION['tqn'])
        {
           $endOfTest=true;
        }

    }
    
    
    else if(isset($_REQUEST['previous']))
    {
    // Perform the changes for current question
        $answerStatus='unanswered';
        if(time()<strtotime($_SESSION['endtime']))
        {
            $questionStatus = $this->getQuestionStatus();
            
            if(strcmp($answerStatus,"unanswered")!=0)
            {
                if(strcmp($answerStatus,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                if(!executeQuery($query))
                {
                // to do
                $_GLOBALS['message']="Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
        }
        //previous question
        if((int)$_SESSION['qn']>1)
        {
            $_SESSION['qn']=$_SESSION['qn']-1;
        }

    }
    else if(isset($_REQUEST['fs']))
    {
        //Final Submission
        header('Location: testack.php');
    }
    }
    
    
    
    
    function getQuestionStatus(){
         if(isset($_REQUEST['markreview']))
            {
                $questionStatus='review';
            }
            else if(isset($_REQUEST['answer']))
            {
                $questionStatus='answered';
            }
            else
            {
                $questionStatus='unanswered';
            }
    }
    
  

}

         



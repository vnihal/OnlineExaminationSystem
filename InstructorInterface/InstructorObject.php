<?php

include_once'../AdminInterface/User.php';
include 'ExamObject.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstructorObject
 *
 * @author Eray
 */
class InstructorObject extends User{

      
    
    
        public function listOfMycourses($userid){
            
            $query = "SELECT course.courseid,coursename FROM course,courseinstructor WHERE course.courseid=courseinstructor.courseid AND userid='$userid'";
            $result = mysql_query($query);
            
            return $result;
          
          
          
      }
      
      public function createexam($examName,$examType,$courseId,$startDate,$endDate,$duration,$secretCode,$userId){
          
          $Exam=new ExamObject($examName,$examType,$courseId,$startDate,$endDate,$duration,$secretCode);
      
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
          
           header("location:./insmyexams.php");
          
          
      }
      
      public function listExams($userid){
          $query = "SELECT exam.examid,examtype,examname,courseid,StartDate,EndDate,Duration,secretcode FROM exam,instructor_exam WHERE exam.examid=instructor_exam.examid AND UserId='$userid'";
           
          $resultSet = mysql_query($query) or die (mysql_error());
     
     return $resultSet;
          
      }
      
      
     public function deleteExam($deletedexamid){
         $query = "DELETE from exam where examid='$deletedexamid'";
        mysql_query($query) or die (mysql_error());
     }
     
     public function UpdateExam($examName,$examType,$courseId,$startDate,$endDate,$duration,$secretCode,$examid){
         
         
         $completeSql = "UPDATE exam " . "SET examtype='$examType',examname='$examName',courseid='$courseId',StartDate='$startDate',EndDate='$endDate',Duration='$duration',secretcode='$secretCode' " .
                "WHERE examid='$examid';";
         mysql_query($completeSql) or die (mysql_error());
         
         
     }
     
     
     
}

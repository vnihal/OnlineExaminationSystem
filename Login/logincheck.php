<?php

session_start(); // Starting Session
include ("../ConnectionDatabase.php");
include '../AdminInterface/User.php';
include '../AdminInterface/Admin.php';
include '../StudentInterface/StudentObje.php';
include '../InstructorInterface/InstructorObject.php';
include '../TeachingAssistantInterface/TeachingAssistant.php';

$error=''; // Variable To Store Error Message
if (isset($_POST['Login'])) {
if (empty($_POST['userId']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
 $result=User::userlogin($_POST['userId'],$_POST['password']);
    

    if ($result['existrecord']!=0) {
    
            $_SESSION['userId']=$result['queryarray']['FirstName']. ' ' .$result['queryarray']['LastName']; // Initializing Session
            $_SESSION['UserId']=$result['queryarray']['UserId'];
                    if($result['queryarray']['Privilege_id']==1){
                        
                        $_SESSION['admin_login']="OK";
                       $currentAdmin = new Admin();
                       $currentAdmin->setUserid($result['queryarray']['UserId']);
                       $currentAdmin->setFirstname($result['queryarray']['FirstName']);
                       $currentAdmin->setLastname($result['queryarray']['LastName']);
                       $currentAdmin->setPrivilege($result['queryarray']['Privilege_id']);
                       $currentAdmin->setTelno($result['queryarray']['TelNum']);
                        
                        
                        $_SESSION['currentAdmin'] = $currentAdmin;
                        
                        
                        header("location:../AdminInterface/AdminHome.php"); // Redirecting To Other Page
                    }
                     if($result['queryarray']['Privilege_id']==2){
                        $_SESSION['instructor_login']="OK";
                       $currentInstructor = new InstructorObject();
                       $currentInstructor->setUserid($result['queryarray']['UserId']);
                       $currentInstructor->setFirstname($result['queryarray']['FirstName']);
                       $currentInstructor->setLastname($result['queryarray']['LastName']);
                       $currentInstructor->setPrivilege($result['queryarray']['Privilege_id']);
                       $currentInstructor->setTelno($result['queryarray']['TelNum']);
                      
                       $_SESSION['currentInstructor'] = $currentInstructor;
 
                         
                
                         
                      header("location:../InstructorInterface/inshomepage.php"); 
                    }
                     if($result['queryarray']['Privilege_id']==3){
                         
                          $_SESSION['teachingassistant_login']="OK";
                       $currentTeachingAssistant = new TeachingAssistant();
                       $currentTeachingAssistant->setUserid($result['queryarray']['UserId']);
                       $currentTeachingAssistant->setFirstname($result['queryarray']['FirstName']);
                       $currentTeachingAssistant->setLastname($result['queryarray']['LastName']);
                       $currentTeachingAssistant->setPrivilege($result['queryarray']['Privilege_id']);
                       $currentTeachingAssistant->setTelno($result['queryarray']['TelNum']);
                      
                       $_SESSION['currentTeachingAssistant'] = $currentTeachingAssistant;
 
                         
                
                         
                      header("location:../TeachingAssistantInterface/TAhomepage.php"); 
                         
                         
    
                    }
                      if ($result['queryarray']['Privilege_id']==4) {
                     
                          $_SESSION['student_login'] = "OK";
                          $currentStudent = new StudentObje();
                          $currentStudent->setUserid($result['queryarray']['UserId']);
                          $currentStudent->setFirstname($result['queryarray']['FirstName']);
                          $currentStudent->setLastname($result['queryarray']['LastName']);
                          $currentStudent->setPrivilege($result['queryarray']['Privilege_id']);
                          $currentStudent->setTelno($result['queryarray']['TelNum']);
                          $_SESSION['currentStudent'] = $currentStudent;
    
                          header("location:../StudentInterface/stdhomepage.php");
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                        
    
                      }
                    } 
                      else {
                         $error = "Username or Password is invalid";
                         header("location:Login.php");
                           }
                        mysql_close($connection); // Closing Connection
                  }
          }
?>

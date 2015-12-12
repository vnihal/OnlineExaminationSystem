<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'User.php';
require_once 'Course.php';


/**
 * Description of Admin
 *
 * @author Nihal
 */
//include 'User.php';

class Admin extends User {
    //put your code here

    
       public function addUser(User $User){
        
        $userid=$User->getUserid();
        $userpass=$User->getUserpassword();
        $email=$User->getEmail();
        $telnum=$User->getTelno();
        $firstname=$User->getFirstname();
        $lastname=$User->getLastname();
        $previlege=$User->getPrivilege();
        
        $add =mysql_query("insert into user (`UserId`, `UserPassword`, `emaill`, `TelNum`, `FirstName`, `LastName`, `Privilege_id`) values ('$userid','$userpass','$email','$telnum','$firstname','$lastname','$previlege')");
        
        
        }
        
         public function viewListOfUser() {
        
         $contacts = mysql_query("
                        SELECT * FROM user") or die( mysql_error() );
        
         return $contacts;
    }
    
        public function deleteUser($Userid){
            
            $contacts = mysql_query("
                        DELETE FROM user WHERE UserId='$Userid'") or die( mysql_error() );
            
            return mysql_affected_rows($contacts); //false a -1 döndürür.true is sayısını döndürür.
          
        }
        
        public function updateUserInfo($userid,$password,$emaill,$telnum,$firstname,$lastname,$previleged){
            
            $update =mysql_query("UPDATE user SET UserId='$userid',UserPassword='$password',emaill='$emaill',TelNum='$telnum',FirstName='$firstname',LastName='$lastname',Privilege_id='$previleged' WHERE UserId='$userid'");
        
            
        }
    
        public function takeuserinfo($userid){
            
          $contacts = mysql_query("
                        SELECT * FROM user WHERE Userid='$userid'") or die( mysql_error() );  
          
          return $contacts;
            

}
      public function addcourse($courseid,$coursename,$belongstoinstructor){
       
        $course=new Course($courseid,$coursename,$belongstoinstructor);
        $add1 =mysql_query("insert into course (`courseid`, `coursename`) values ('$courseid','$coursename')") or die( mysql_error());
        $add2 =mysql_query("insert into courseinstructor (`userid`, `courseid`) values ('$belongstoinstructor','$courseid')") or die( mysql_error());
        
         }
         
         
          public function viewListOfCourse() {
        
         $contacts = mysql_query("
                        SELECT courseinstructor.courseid,coursename,courseinstructor.userid,FirstName,LastName FROM courseinstructor JOIN user ON user.UserId=courseinstructor.userid JOIN course ON course.courseid=courseinstructor.courseid") or die( mysql_error() );
        
         return $contacts;
    }
     public function deleteCourse($courseid){
            
            $contacts = mysql_query("
                        DELETE FROM course WHERE courseid='$courseid'") or die( mysql_error() );
            
            return mysql_affected_rows($contacts); //false a -1 döndürür.true is sayısını döndürür.
          
        }
     public function updateCourseInfo($previouscourseid,$newcourseid,$coursename,$belongstoid){
            
            $update1 =mysql_query("UPDATE course SET courseid='$newcourseid',coursename='$coursename' WHERE courseid='$previouscourseid'");
            $update2 =mysql_query("UPDATE courseinstructor SET courseid='$newcourseid',userid='$belongstoid' WHERE courseid='$previouscourseid'");
            
        }
         
     public function takecourseinfo($courseid){
            
          $contacts = mysql_query("
                        SELECT courseinstructor.courseid,coursename,courseinstructor.userid,FirstName,LastName FROM courseinstructor JOIN user ON user.UserId=courseinstructor.userid JOIN course ON course.courseid=courseinstructor.courseid WHERE courseinstructor.courseid='$courseid'") or die( mysql_error() );  
          
          return $contacts;
         
     }
}
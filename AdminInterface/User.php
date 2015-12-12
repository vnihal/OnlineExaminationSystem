<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Nihal
 */
class User {
    //put your code here
    private $userid;
    private $userpassword;
    private $email;
    private $telno;
    private $firstname;
    private $lastname;
    private $previlege;
    
    function __construct($userid,$userpassword) {
        $this->userid=$userid;
        $this->userpassword=$userpassword;
        
    }
    
    public function getUserid() {
        return $this->userid;
    }

    public function getUserpassword() {
        return $this->userpassword;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelno() {
        return $this->telno;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getPrivilege() {
        return $this->previlege;
    }

    public function setUserid($userid) {
        $this->userid = $userid;
    }

    public function setUserpassword($userpassword) {
        $this->userpassword = $userpassword;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelno($telno) {
        $this->telno = $telno;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setPrivilege($previlege) {
        $this->previlege = $previlege;
    }
     
    function getPriviligeStatus() {
        $status ="";
        switch($this->getPrivilege()){
            case "1":
                $status = "Admin";
            case "2":
                $status = "Instructor";
            case "3":
                $status = "Teaching Assistan";
            case "4":
                $status = "Student";
        }
        return $status;
    }


    public function userlogin($userid,$userpassword){
        
        $query = mysql_query("select * from user where UserPassword='$userpassword' AND UserId='$userid'");
       
        return array('existrecord'=>mysql_num_rows($query),'queryarray'=>mysql_fetch_array($query));
        
    }
    
  //public function userlogout(){
    //    session_start();

   //     if(session_destroy()) // Destroying All Sessions
   //      {
     //  header("Location:../Index.php"); // Redirecting To Home Page
  // }
   // }

}
   ?>
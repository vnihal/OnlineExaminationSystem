<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course
 *
 * @author Nihal
 */
class Course {
    //put your code here
    private $courseid;
    private $coursename;
    private $belongtoinstructor;
    
    
    function __construct($courseid,$coursename,$belongsto) {
        $this->courseid=$courseid;
        $this->coursename=$coursename;
        $this->belongtoinstructor=$belongsto;
    
    }
    
    public function getCourseid() {
        return $this->courseid;
    }

    public function getCoursename() {
        return $this->coursename;
    }

    public function getBelongtoinstructor() {
        return $this->belongtoinstructor;
    }

    public function setCourseid($courseid) {
        $this->courseid = $courseid;
    }

    public function setCoursename($coursename) {
        $this->coursename = $coursename;
    }

    public function setBelongtoinstructor($belongtoinstructor) {
        $this->belongtoinstructor = $belongtoinstructor;
    }


}

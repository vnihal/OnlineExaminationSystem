<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserObje
 *
 * @author Nihal
 */
class UserObje {
    //put your code here
    private $userid;
    private $userpassword;
    private $email;
    private $telno;
    private $firstname;
    private $lastname;
    private $previlege;
    function getUserid() {
        return $this->userid;
    }

    function getUserpassword() {
        return $this->userpassword;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelno() {
        return $this->telno;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getPrevilege() {
        return $this->previlege;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    function setUserpassword($userpassword) {
        $this->userpassword = $userpassword;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelno($telno) {
        $this->telno = $telno;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setPrevilege($previlege) {
        $this->previlege = $previlege;
    }


}

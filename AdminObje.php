<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'ConnectionDatabase.php';
require_once 'UserObje.php';
/**
 * Description of AdminObje
 *
 * @author Nihal
 */
class AdminObje extends UserObje {
    //put your code here
    
    public function viewListOfUser() {
        
        $contacts = mysql_query("
                        SELECT * FROM user") or die( mysql_error() );
        
        return $contacts;
    }
    
    
    
    
}

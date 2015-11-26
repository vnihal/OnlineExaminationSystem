<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Nihal
 */
//class ConnectionDatabase {
    
   
    //public function connect(){
        $vtadi="se301oes"; 
	$baglan=mysql_connect("localhost", "root", "");
          if(!$baglan){
              die('Bagli Degil:' .mysql_error());
         }
             $b=mysql_select_db($vtadi,$baglan); 

            if(!$b){
                die("veritabani alinamadi".mysql_error());} 
   //}

?>
<?php

include ("ConnectionDatabase.php"); 
include ("./adminLoginControl.php");
//require_once 'ConnectionDatabase.php';



$userid=$_POST['userid'];
$email = $_POST['emaill'];
$telnum = $_POST['telnum'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$previlege = $_POST['previleged'];
// input name posta gönderiyorum
//Veritabanında bulunan 'defter' isimli tablonun 'defter_isim' ve 'defter_soyisim' alanlarına kayıt edelim.
//$add = mysql_query("insert into developer (defter_id, defter_isim, defter_soyisim) values (NULL, '$ad', '$soyad')") or die("Hata: kayıt işlemi gerçekleşemedi.");
$add =mysql_query("UPDATE user SET UserId='$userid',emaill='$email',TelNum='$telnum',FirstName='$firstname',LastName='$lastname',Previleged='$previlege' WHERE UserId='$userid'");
if(!$add){
    echo 'User Updated';
    echo mysql_error();
}
 
header("location: ViewUser.php");

?>




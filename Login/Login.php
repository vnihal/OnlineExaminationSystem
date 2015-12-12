<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->






<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../Media/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Media/css/structure.css">
</head>
<body>
    <form action="logincheck.php" class="box login" method="post">
        <div class="headern">Welcome to OES
  </div>
	<fieldset class="boxBody">
	  <label>User ID</label>
	  <input type="text" name="userId" tabindex="1" placeholder="User ID" >
	  <label><a href="#" class="rLink" tabindex="5">Forget your password?</a>Password</label>
	  <input type="password" name="password" tabindex="2" placeholder="Password" >
	</fieldset>
	<footer>
	  <label><input type="checkbox" tabindex="3">Keep me logged in</label>
	  <input type="submit" name="Login" class="btnLogin" value="Login"  tabindex="4">
	</footer>
</form>
    
</body>
</html>

<?php

   include('logincheck.php'); // Includes Login Script

//if(isset($_SESSION['UserId'])){
// header("location:AdminPage.php");
//}
?>
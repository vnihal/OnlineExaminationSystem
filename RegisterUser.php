<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    
    <?php
include 'Admin.php';
include 'ConnectionDatabase.php';
include ("./adminLoginControl.php");

?>
<div>
    <h1>Register User </h1> <br>
    
</div>



<form action="InsertUser.php" method="post">
    <table class="table" border= "0" id="contact-list">
                        <thead>
                            
                             <tr>
                                <td>User ID</td>
                                 
                                 <td><input type="text" name="userid" placeholder="User ID" /></td>
                            </tr>
                            
                            <tr>
                                <td>User Password</td>
                                <td> <input type="text" name="password"  placeholder="Password" ></td>
                            
                            </tr>
                            <tr>
                                <td>First Name</td>
                                 
                                 <td><input type="text" name="firstname" placeholder="First Name" /></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                 
                                 <td><input type="text" name="lastname" placeholder="Last Name"  /></td>
                            </tr>
                            
                            
                            
                            <tr>
                                <td>Email</td>
                                
                                 <td><input type="email" name="emaill" placeholder="Email"/>
                            </tr>
                            <tr>
                                <td>Telephone Number </td>
                                 
                                 <td><input type="text" name="telnum" placeholder="Telephone Number" /></td>
                            </tr>
                            
                            <tr>
                                <td>Previleged</td>
                               
                                 <td><input type="text" name="previleged" placeholder="Previlege Number"  /></td>
                            </tr>
                            
                            <td>
                              <input type="submit" name="button"  value="REGİSTER" />
                            
                            <input type="button" onClick="location.href='ViewUser.php'" name="button"  value="BACK" />
                            </td>
                        </thead>
</table>
                        
    
  
</form>



    <?php
    // put your code here
    ?>
</body>
</html>


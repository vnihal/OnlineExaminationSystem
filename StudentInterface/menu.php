
<?php
error_reporting(0);
//Student main page!
//session_start();
//include 'Login/logincheck.php';
//include './studentLoginControl.php';
//include 'dbconnect.php';
//include 'StudentObje.php';

//$connection = mysql_connect('localhost','root','');
//mysql_select_db('oesdatabase',$connection);
?>
 <?php
  session_start();
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../Media/css/style.css" rel="stylesheet" />
    <title></title>
</head>
<body>
    <div class="header"></div>
    
    <div id='cssmenu'>
        
       <ul>
           <li style="margin-left:234px;"><a href='stdhomepage.php'>Home</a></li>
            <li class='active'>
                <a href='stdviewresults.php'>View Results</a>
                

            </li>
            <li>
                <a href='stdselectcourse.php'>Take A New Test</a>
                
            </li>
            <li>
                <a href='stdresumeexam.php'>Resume Test</a>
                
            </li>
            
            
            <div class="profile">
            <li style="float:right;">
                <a href='#' class="profileview"><?php echo $_SESSION['userId'];?></a>
                <ul>
                    <li>
                        <a href='stdprofile.php'>Change Password</a>

                    </li>
                    <li>
                        <a href='../Login/Logout.php'>Log Out</a>

                    </li>
                </ul>
            </li>
            </div>

        </ul>
    </div>
   
</body>
</html>

           
            
            <?php
if($_GLOBALS['message']) {
echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
}
?>
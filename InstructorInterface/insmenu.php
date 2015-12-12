<?php
error_reporting(0);
//include './inslogincheck.php';

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
           <li style="margin-left:234px;"><a href='inshomepage.php'>Home</a></li>
            <li class='active'>
                <a href='insmyexams.php'>My Exams</a>
                

            </li>
            <li>
                <a href='insprepareexam.php'>Prepare A New Exam</a>
                
            </li>
            <li>
                <a href='insreviewexam.php'>Review Exam</a>
                
            </li>
            
            
            <div class="profile">
            <li style="float:right;">
                <a href='#' class="profileview"><?php echo $_SESSION['userId'];?></a>
                <ul>
                    <li>
                        <a href='inschangepass.php'>Change Password</a>

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

           
            
           
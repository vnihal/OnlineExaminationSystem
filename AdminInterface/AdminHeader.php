<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            <li style="margin-left:234px;"><a href='AdminHome.php'>Home</a></li>
            <li class='active'>
                <a href='AdminHome.php'>Manage User</a>
                <ul>
                    <li>
                        <a href='RegisterUser.php'>Add User</a>

                    </li>
                    <li>
                        <a href='UserList.php'>User List</a>

                    </li>
                </ul>

            </li>
            <li>
                <a href='AdminHome.php'>Manage Course</a>
                <ul>
                    <li>
                        <a href='RegisterCourse.php'>Add Course</a>

                    </li>
                    <li>
                        <a href='CourseList.php'>Course List</a>

                    </li>
                </ul>
            </li>
            <div class="profile">
            <li style="float:right;">
                <a href='AdminHome.php' class="profileview"><?php echo $_SESSION['userId'];?></a>
                <ul>
                    <li>
                        <a href='adminchangepass.php'>Change Password</a>

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

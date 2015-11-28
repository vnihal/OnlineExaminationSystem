 <?php
include 'Admin.php';
?>
<div>
    
    <h1 class="me">List Of User </h1> <br>
    
</div>
<link rel="stylesheet" type="text/css" href="../Media/css/my.css">

    <?php
 
 require_once 'AdminObje.php';
 $Abmininstance=new AdminObje();
 $contacts=$Abmininstance->viewListOfUser();

                    // If results
                    if( mysql_num_rows( $contacts ) > 0 )
                    ?>

    <table class="table" border= "5" id="contact-list">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Previliged As</th>
                                <th>Delete User</th>
                                <th>Edit User</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while( $contact = mysql_fetch_array( $contacts ) ) : ?>



                            <tr>
                                <td class="contact-name"><?php echo $contact['UserId']; ?></td>
                                <td class="contact-firstname"><?php echo $contact['FirstName']; ?></td>
                                <td class="contact-lastname"><?php echo $contact['LastName']; ?></td>
                                <td class="contact-email"><?php echo $contact['emaill']; ?></td>
                                <td class="contact-previlege"><?php echo $contact['Previleged']; ?></td>
                                <td class="contact-delete">
                                    <form action='delete.php' name="<?php echo $contact['UserId']; ?>" method="post">
                <input type="hidden" name="UserId" value="<?php echo $contact['UserId']; ?>">
                <input type="submit" name="submit" value="Delete" >
                </form></td>  
                
                                  <td class="contact-edit">
                                  <form action='edit.php' name="<?php echo $contact['UserId']; ?>" method="get">
                <input type="hidden" name="UserId" value="<?php echo $contact['UserId']; ?>">
                <input type="submit" name="submit" value="Edit" >
                </form> </td> 
                
                                
                            </tr>

                        <?php endwhile; ?>

                        </tbody>
                    </table>
<br>

                    <!--<input type="button" onClick="location.href='IndexAdmin.php'" name="button" id="9" value="BACK" />-->

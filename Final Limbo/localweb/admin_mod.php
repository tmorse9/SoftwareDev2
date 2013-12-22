<!DOCTYPE html>
<html>
<head>
<?php   
     $logo = "images/limbo.jpg" ;
     

     echo '<TABLE border="0">';
       echo '<TR>';
         echo '<TH><a href="linkyalpha.php"><img border="0" src="' . $logo . '" alt=" " height="100"   width="100"></a></TH>';
         echo '<TH><font size= "100">Admin Catalog<font></TH>';
       echo '<TR><font size= "10"> </font></TR>';

#Links to other pages start here

       echo  '<TR>' ;
         echo  '<TD><font size= "4"><a href="alphalost.php">Lost something</a></font></TD>';
         echo  '<TD><font size= "4"><a href="alphafound.php">Found something</a> 
                    <a href="alphaitem_catalog.php">Item Catalog</a>   
                    <a href="alphaitem_pickup.php">Item Drop off and Pick up</a>
                    <a href="alphaadmins.php">Admins</a></font>
                    </TD> ' ;
         echo  '</TR>' ;
         echo  '<tr>' ;
         echo  '<td></td>' ;
         echo  '<td><a href="adminedit.php">Admin home</a>
                    <a href="admin_mod.php">Add Admin</a>
                    <a href="admin_delete.php">Remove Admin</a>
                    <a href="admin_update.php">Update Admin</a></td>' ;
         echo  '</tr>';
        
       echo '</TR>';
     echo '</TABLE>';
?>


</head>
<?php

     require( 'includes/helpersalpha.php' ) ;

     #initializes database
     $dbcl = initlogin();

     if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $username = $_POST['username'] ;

          $password = $_POST['password'] ;


          if(!valid_name($username)) {
             echo '<p style="color:red;font-size:16px;">Add Admin Username</p>';
        } else if (!valid_name($password)) {
             echo '<p style="color:red;font-size:16px;">Add Admin Password</p>';
        } else {
             insert_admin_record($dbcl,$username,$password) ;
        }
     } else if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
        if(isset($_GET['id'])) {
             show_admin_record($dbcl, $_GET['id']) ;
        }
     }


     # Show the records
     show_admin_records($dbcl);

     # Close the connection
     mysqli_close( $dbcl ) ;
?>
<!-- Get inputs from the user. -->
<h1>Admin Set Up</h1>
<form action="admin_mod.php" method="POST">
<table>
<tr>
<tr><p>Enter New Admin:</tr><tr> <input type="text" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"> </p></tr>
<tr><p>Enter Password for new admin:</tr><tr> <input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"> </p></tr>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
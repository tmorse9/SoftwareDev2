<!DOCTYPE html>
<html>
<head>
<?php   
     $logo = "images/limbo.jpg" ;
     
  
     echo '<TABLE border="0">';
       echo '<TR>';
         echo '<TH><a href="linkyalpha.php"><img border="0" src="' . $logo . '" alt=" " height="100"   width="100"></a></TH>';
         echo '<TH><font size= "100">Admin Update<font></TH>';
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

   $change_id = $_POST['change_id'];
   $new_password = $_POST['new_password'];

Admin_update_password($dbcl,$change_id,$new_password);
echo '<p> The password has been updated!</p>';

}

show_admin_delete_records($dbcl) ;

 # Close the connection
     mysqli_close( $dbcl ) ;

?>

<form  method="POST" action="admin_update.php">
  <p>Enter id to update user: <input name="change_id" type="int" id="id"></p>
  <p>Enter new password: <input name="new_password" type="password" id="id"></p>
   <p><input  type="submit" name="status" value="submit"></p>
</form>
</html>












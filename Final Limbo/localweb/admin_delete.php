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


if(isset($_GET['delete_admin_id'] )){
   $delete_admin_id = $_GET['delete_admin_id'] ;


Admin_delete_user($dbcl,$delete_admin_id);
}

show_admin_delete_records($dbcl);

 # Close the connection
     mysqli_close( $dbcl ) ;

?>

<form  method="GET" action="admin_delete.php">
  <p>Enter id to remove item: <input name="delete_admin_id" type="int" id="id"></p>
   <p><input  type="submit" name="delete" value="delete"></p>
   </form>
   </html>
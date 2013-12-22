
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
     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Includes these helper functions
     require( 'includes/helpersalpha.php' ) ;

     #initializes database
     $dbca = init();

    




if(isset($_GET['delete_id'] )){
   $delete_id = $_GET['delete_id'] ;


Admin_delete_records($dbca,$delete_id);
}


if(isset($_GET['claimed_id'] )){
   $claimed_id = $_GET['claimed_id'];

Admin_claimed_records($dbca,$claimed_id);

}

show_ac_records($dbca) ;

 # Close the connection
     mysqli_close( $dbca ) ;
     
?>



<!-- Get inputs from the user. -->
<!-- HTML with embedded PHP -->





<form  method="GET" action="adminedit.php">
  <p>Enter id to remove item: <input name="delete_id" type="int" id="id"></p>
   <p><input  type="submit" name="delete" value="delete"></p>
   <p>Enter id of claimed item: <input name="claimed_id" type="Text" id="id"></p>
   <p><input  type="submit" name="status" value="submit"></p>
   
</form>

</html>
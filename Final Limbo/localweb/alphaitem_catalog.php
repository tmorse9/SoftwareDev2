<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Brad Huntington, Tom Morse
-->
<!DOCTYPE html>
<html>
<head>
<?php   
     $logo = "images/limbo.jpg" ;
     
     #$welcome = "Welcome to Limbo!" ;

     #echo "<h1>" . $welcome . "</h1>" ;
     #echo "<img border=\"0\" src=" . $logo . " alt=\"Limbo\">";
     #echo '<H1>Welcome To Limbo</H1>' ;
     echo '<TABLE border="0">';
       echo '<TR>';
         echo '<TH><a href="linkyalpha.php"><img border="0" src="' . $logo . '" alt=" " height="100" width="100"></a></TH>';
         echo '<TH><font size= "100">Full Item Catalog<font></TH>';
       echo '<TR><font size= "10"> </font></TR>';

#Links to other pages start here

         echo '<Td><font size= "4"><a href="alphalost.php">Lost something</a></font> </Td>';
         echo '<Td><font size= "4"><a href="alphafound.php">Found something</a>
               &nbsp<a href="alphaadmins.php">Admins</a></font> 
               <a href="alphaitem_catalog.php">Item Catalog</a>
               &nbsp<a href="alphaitem_pickup.php">Item Drop off and Pick up</a></Td>';
        
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

    
#controls id links must keep
     if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	      if(isset($_GET['id'])) {
	           show_record($dbca, $_GET['id']) ;
	      }
     }


     # Show the records
     show_catalog_records($dbca);

     # Close the connection
     mysqli_close( $dbca ) ;

?>


</html>
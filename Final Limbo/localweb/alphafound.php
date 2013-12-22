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

     echo '<TABLE border="0">';
       echo '<TR>';
         echo '<TH><a href="linkyalpha.php"><img border="0" src="' . $logo . '" alt=" " height="100" width="100"></a></TH>';
         echo '<TH><font size= "100">Report Found Items<font></TH>';
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

     if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $item = $_POST['item'] ;

          $status = $_POST['status'] ;

          $datetime = $_POST['date_time'] ;

          $location = $_POST['location'] ;

          $description = $_POST['description'] ;

          if(!valid_name($item)) {
             echo '<p style="color:red;font-size:16px;">Add an Item</p>';
        } else if (!valid_name($status)) {
             echo '<p style="color:red;font-size:16px;">Add Status</p>';
        } else if (!valid_name($datetime)) {
             echo '<p style="color:red;font-size:16px;">Add Date Found</p>';
        } else if (!valid_name($location)) {
             echo '<p style="color:red;font-size:16px;">Add Location Found</p>';
        } else if (!valid_name($description)) {
             echo '<p style="color:red;font-size:16px;">Add Breif Description</p>';
        } else {
             insert_record($dbca,$item,$status,$datetime,$location,$description) ;
        }
     } else if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
        if(isset($_GET['id'])) {
             show_record($dbca, $_GET['id']) ;
        }
     }


     # Show the records
     show_link_records($dbca);

     # Close the connection
     mysqli_close( $dbca ) ;

?>

<!-- Get inputs from the user. -->
<!-- HTML with embedded PHP -->

<form action="alphalost.php" method="POST">
<table>
   <tr><p>Item:</tr><tr> <input type="text" name="item" value="<?php if (isset($_POST['item'])) echo $_POST['item']; ?>"> </p></tr>
   <tr><p>Status:</tr><tr> <select name = "status">
                            <option value = "found">Found
                                                       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            </option>
                            </select>
    <!-- only need 1 select because it is the lost page and only lost items are inputed here-->                 

   <!--<input type="text" name="status" value="<?php #if (isset($_POST['status'])) echo $_POST['status']; ?>"> </p></tr>-->
   <tr><p>Date: </tr><tr><input type="date" name="date_time" value="<?php if (isset($_POST['date_time'])) echo $_POST['date_time']; ?>"> </p></tr>
   <tr><p>Location:</tr><tr> <select name = "location">
                            <option value="">Enter Location </option>
                            <option value="Midrise"> Midrise</option>
                            <option value="Library">Library </option>
                            <option value="McCann">McCann</option>
                            <option value="Foy">Foy</option>
                            <option value="Gartland">Gartland </option>
                            <option value="Lowell Thomas">Lowell Thomas </option>
                            <option value="Dyson">Dyson </option>
                            <option value="Lower west cedar">Lower west cedar </option>
                            <option value="Upper Fulton">Upper Fulton </option>
                            <option value="St. Peters">St. Peters </option>
                            <option value="Hancock">Hancock </option>
                            <option value="Marian">Marian </option>
                            <option value="Champagnat">Champagnat </option>
                            <option value="Bryne house ">Bryne house </option>
                            <option value="Chapel">Chapel </option>
                            <option value="Cornel boathouse">Cornel boathouse </option>
                            <option value="Donnelly Hall">Donnelly Hall </option>
                            <option value="Fontain Annex ">Fontain Annex </option>
                            <option value="Fontain">Fontain </option>
                            <option value="Fulton">Fulton </option>
                            <option value="New Fulton">New Fulton </option>
                            <option value="Greystone Hall">Greystone Hall </option>
                            <option value="Kieran Gatehouse">Kieran Gatehouse </option>
                            <option value="Kirk House">Kirk House </option>
                            <option value="Leo">Leo </option>
                            <option value="Lower Townhouses">Lower Townhouses </option>
                            <option value="Marist Boathouse">Marist Boathouse </option>
                            <option value="New Townhouses">New Townhouses </option>
                            <option value="Sheahan">Sheahan </option>
                            <option value="Rotunda">Rotunda</option>
                            <option value="Teeney Stadium">Teeney Stadium</option>
                            <option value="Tennis Pavillion">Tennis Pavillion</option>
                                          <!-- &nbsp to make inputs align right-->
                            <option value="Upper West Cedar Townhouse">Upper West Cedar &nbsp &nbsp  </option>
                            <option value="Steel Plant">Steel Plant</option>
                            <option value="St. Anns">St. Anns</option>
                            </select>
   <!-- </tr><tr> <input type="text" name="location" value="<?php# if (isset($_POST['location'])) echo $_POST['location']; ?>"> </p></tr>-->
   <tr><p>Description: </tr><tr><input type="text" name="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"> </p></tr>
     <p><input type="submit"></p>

</form>
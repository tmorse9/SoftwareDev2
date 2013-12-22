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

    if(!empty($item) && !empty($status))  {
      $result = insert_record($dbca, $item, $status) ;

      #echo "<p>Added " . $result . " new print(s) ". $name . " @ $" . $price . " .</p>" ;
    }
    else
      echo '<p style="color:red">Please input an Item and its status</p>' ;
}

# Show the records
show_records($dbca);

# Close the connection
mysqli_close( $dbca ) ;
?>

<!-- Get inputs from the user. -->
<form action="alphalanding.php" method="POST">
<table>
<tr>
<td>Item:</td><td><input type="text" name="item"></td>
</tr>
<tr>
<td>Status:</td><td><input type="text" name="status"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
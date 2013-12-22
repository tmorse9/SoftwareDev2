<!DOCTYPE html>
<html>
<head>
<?php   
     $logo = "images/limbo.jpg" ;
  
     echo '<TABLE border="0">';
       echo '<TR>';
         echo '<TH><a href="linkyalpha.php"><img border="0" src="' . $logo . '" alt=" " height="100" width="100"></a></TH>';
         echo '<TH><font size= "100">Item Drop off and Pick up<font></TH>';
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
<h2> Drop off Procedure</h2>
	<p> If you have found a lost item please bring it to the Limbo office!<p>
	<p> The item will be stored amongst other lost items in our office's inventory. <p>

<h2> Pick up Procedure</h2>
	<p> If we have your lost item please come to the limbo office with proof of ownership.<p>


	<h3><strong>Office Location:</strong></h3>
	
	<p><strong>Donnely:</strong> 202</p>

    <h3><strong>Hours of opperation:</strong></h3>
    <p><strong>Monday-Friday:</strong> 9:30-6:00</p>
    <p><strong>Saturday-Sunday:</strong> 11:00-4:00</p>

<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who	Date		Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
#require( 'includes/connectlogin_db.php' ) ;

# Connect to MySQL server and the database
require( 'includes/limbo_login_tools.php' ) ;

#initializes database
     $dbcl = initlogin();

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

	$uname = $_POST['username'] ;

	$pword = $_POST['password'] ;

    $pid = validate($pword) ;

    if($pid == -1)
      echo '<P style=color:red>Login failed please try again.</P>' ;

    else
      load('adminedit.php');
}
?>
<!-- Get inputs from the user. -->
<h1>Admin login</h1>
<form action="alphaadmins.php" method="POST">
<table>
<tr>
<td>Username:</td><td><input type="text" name="username"></td>
</tr>
<td>Password:</td><td><input type="password" name="password"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
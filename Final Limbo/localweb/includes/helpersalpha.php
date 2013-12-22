<?php
$debug = true;

function init() {
     #the database we connect to
     $DB_NAME = 'alpha_db';

     #connect to the database, vreate it if necessary 
     $dbca = connect_db($DB_NAME);

     #populate the database
     populate_db($dbca);

     return $dbca;
}

# Populates the database
function populate_db($dbca) {
    # Create prints table, if it doesnt exist
    $query  = 'CREATE TABLE IF NOT EXISTS lfitems ';
    $query .= '( id INT AUTO_INCREMENT PRIMARY KEY, ';
    $query .= '  item text ,';
    $query .= '  status text, ';
    $query .= '  date_time DATE, ';
    $query .= '  location text, ';
    $query .= '  description text, ';
    #show_query($query);

    $results = mysqli_query($dbca,$query);
    check_results( $results );

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM lfitems';
    #show_query( $query );

    $results = mysqli_query($dbca,$query);
    check_results( $results );

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0)
            return;
    }

    # If we get here, populate the table
    $query = "INSERT INTO lfitems(item,status,date_time,location,description) 
           VALUES ('Iphone 5s', 'Found', '2013:02:22', 'Hancock', 'Gold'),
           ('Nalgene Bottle', 'Found', '2013:10:30', 'Dyson', 'Neon orange'),
           ('Coffee Cup', 'Lost', '2013:04:13', 'Midrise', 'white and brown'),
           ('Macbook Air', 'Lost', '2013:04:13', 'Midrise', 'silver'),
           ('Keys', 'Found', '2013:04:27', 'Midrise', 'Room and mail box keys on keychain'),
           ('Backpack' , 'Lost', '2013:10:27', 'Donnelly', 'Green North Face back pack')";
    #show_query($query);

    $results = mysqli_query($dbca,$query);
    check_results( $results );
}

# Connects to the database and creates one, if necessary.
function connect_db ($dbname) {
    # Connect to the database, if we fail assume the DB doesnt exist
    $dbca = @mysqli_connect ( 'localhost', 'root', '', '$dbname' );

    if($dbca) {
        mysqli_set_charset( $dbca, 'utf8' ) ;
        return $dbca;
    }

    # Create the database
    $dbca = @mysqli_connect ( 'localhost', 'root', '', '' );

    $query = 'CREATE DATABASE alpha_db';
    #show_query( $query );

    $results = mysqli_query($dbca, $query);
    check_results($results);

    # Close connection since we dont need it
    mysqli_close( $dbca );

    # Connect to the (newly created) database
    $dbca = @mysqli_connect ( 'localhost', 'root', '', $dbname )
        OR die ( mysqli_connect_error() ) ;

    # Set encoding to match PHP script encoding.
    mysqli_set_charset( $dbca, 'utf8' ) ;

    return $dbca;
}

function initlogin() {
     #the database we connect to
     $DB_NAME = 'login_db';

     #connect to the database, vreate it if necessary 
     $dbcl = connectlogin_db($DB_NAME);

     #populate the database
     populatelogin_db($dbcl);

     return $dbcl;
}

# Populates the database
function populatelogin_db($dbcl) {
    # Create prints table, if it doesnt exist
    $query  = 'CREATE TABLE IF NOT EXISTS login ';
    $query .= '( id INT AUTO_INCREMENT PRIMARY KEY, ';
    $query .= '  username text ,';
    $query .= '  password CHAR(10), ';
    #show_query($query);

    $results = mysqli_query($dbcl,$query);
    check_results( $results );

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM login';
    #show_query( $query );

    $results = mysqli_query($dbcl,$query);
    check_results( $results );

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0)
            return;
    }

    # If we get here, populate the table
    $query = "INSERT INTO login(username,password) 
           VALUES ('admin', 'gaze11e')" ;
    #show_query($query);

    $results = mysqli_query($dbcl,$query);
    check_results( $results );
}

# Connects to the database and creates one, if necessary.
function connectlogin_db ($dbname) {
    # Connect to the database, if we fail assume the DB doesnt exist
    $dbcl = @mysqli_connect ( 'localhost', 'root', '', '$dbname' );

    if($dbcl) {
        mysqli_set_charset( $dbcl, 'utf8' ) ;
        return $dbcl;
    }

    # Create the database
    $dbcl = @mysqli_connect ( 'localhost', 'root', '', '' );

    $query = 'CREATE DATABASE login_db';
    #show_query( $query );

    $results = mysqli_query($dbcl, $query);
    check_results($results);

    # Close connection since we dont need it
    mysqli_close( $dbcl );

    # Connect to the (newly created) database
    $dbcl = @mysqli_connect ( 'localhost', 'root', '', $dbname )
        OR die ( mysqli_connect_error() ) ;

    # Set encoding to match PHP script encoding.
    mysqli_set_charset( $dbcl, 'utf8' ) ;

    return $dbcl;
}

function show_link_records($dbca) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT id, item, status, date_time, location, description FROM lfitems ORDER BY id DESC LIMIT 5 '  ;

     # Execute the query
     $results = mysqli_query( $dbca , $query ) ;

     
     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>If you lost somthing, you are in luck</strong></p>' ;
          echo '<p> These are the most recent items reported to Limbo</p>';
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>ID</TH>';
          echo '<TH>Item</TH>';
          echo '<TH>Status</TH>';
          echo '<TH>Date</TH>';
          echo '<TH>Location</TH>';
          echo '<TH>Description</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
       	      $alink = '<A HREF=alphaitem_catalog.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
               echo '<TR>' ;
               echo '<TD ALIGN=right>' . $alink . '</TD>' ;
               
               echo '<TD>' . $row['item'] . '</TD>' ;
               echo '<TD>' . $row['status'] . '</TD>' ;
               echo '<TD>' . $row['date_time'] . '</TD>' ;
               echo '<TD>' . $row['location'] . '</TD>' ;
               echo '<TD>' . $row['description'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}

function show_catalog_records($dbca) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT id, item, status, date_time, location, description FROM lfitems ORDER BY id'  ;

     # Execute the query
     $results = mysqli_query( $dbca , $query ) ;

     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>If you lost somthing, you are in luck: this is the place to report it.</strong></p>' ;
          echo '<p> These are the most recent items reported to Limbo</p>';
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>ID</TH>';
          echo '<TH>Item</TH>';
          echo '<TH>Status</TH>';
          echo '<TH>Date</TH>';
          echo '<TH>Location</TH>';
          echo '<TH>Description</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
                $alink = '<A HREF=alphaitem_catalog.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
               echo '<TR>' ;
               echo '<TD ALIGN=right>' . $alink . '</TD>' ;
               #echo '<TD>' . $row['id'] . '</TD>' ;
               #echo '<TD>' . $row['fname'] . '</TD>' ;
               echo '<TD>' . $row['item'] . '</TD>' ;
               echo '<TD>' . $row['status'] . '</TD>' ;
               echo '<TD>' . $row['date_time'] . '</TD>' ;
               echo '<TD>' . $row['location'] . '</TD>' ;
               echo '<TD>' . $row['description'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}

function show_ac_records($dbca) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT id, item, status, date_time, location, description FROM lfitems ORDER BY id'  ;

     # Execute the query
     $results = mysqli_query( $dbca , $query ) ;

     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>Click an item to edit detail or input id number at bottom of page to delete</strong></p>' ;
          echo '<p></p>';
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>ID</TH>';
          echo '<TH>Item</TH>';
          echo '<TH>Status</TH>';
          echo '<TH>Date</TH>';
          echo '<TH>Location</TH>';
          echo '<TH>Description</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
               #$alink = '<A HREF=adminedit.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
               echo '<TR>' ;
               #echo '<TD ALIGN=right>' . $alink . '</TD>' ;
               echo '<TD>' . $row['id'] . '</TD>' ;
               #echo '<TD>' . $row['fname'] . '</TD>' ;
               echo '<TD>' . $row['item'] . '</TD>' ;
               echo '<TD>' . $row['status'] . '</TD>' ;
               echo '<TD>' . $row['date_time'] . '</TD>' ;
               echo '<TD>' . $row['location'] . '</TD>' ;
               echo '<TD>' . $row['description'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}

# Shows the record in prints
function show_record($dbca, $id) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT item, status, date_time, location, description FROM lfitems WHERE id = ' . $id  ;
     #show_query($query) ;

     # Execute the query
     $results = mysqli_query( $dbca , $query ) ;

     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<H1></H1>' ;
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>Item</TH>';
          echo '<TH>Status</TH>';
          echo '<TH>Date</TH>';
          echo '<TH>Location</TH>';
          echo '<TH>Description</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
               echo '<TR>' ;
               echo '<TD>' . $row['item'] . '</TD>' ;
               echo '<TD>' . $row['status'] . '</TD>' ;
               echo '<TD>' . $row['date_time'] . '</TD>' ;
               echo '<TD>' . $row['location'] . '</TD>' ;
               echo '<TD>' . $row['description'] . '</TD>' ;
               echo '</TR>' ;
          }

     	  # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
	}
}

# Shows the records in prints
function show_records($dbca) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT item, status, date_time, location, description FROM lfitems ORDER BY item DESC' ;

     # Execute the query
     $results = mysqli_query( $dbca , $query ) ;

     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<H1>Limbo Welcomes You</H1>' ;
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>Item</TH>';
          echo '<TH>Status</TH>';
          echo '<TH>Date</TH>';
          echo '<TH>location</TH>';
          echo '<TH>Description</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )  {
               echo '<TR>' ;
               echo '<TD>' . $row['item'] . '</TD>' ;
               echo '<TD>' . $row['status'] . '</TD>' ;
               echo '<TD>' . $row['date_time'] . '</TD>' ;
               echo '<TD>' . $row['location'] . '</TD>' ;
               echo '<TD>' . $row['description'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}

function valid_name($anitem) {
     if (empty($anitem)) {
          return false;
     } else {
          return true;
     }
}


function valid_lost($status) {
     if(empty($status)) {
          return false ;
     } else if($status = 'Lost') {
               return true ;
     }
     
}

# Inserts a record into the prints table
function insert_record($dbca, $item, $status, $datetime, $location, $description) {
     $query = 'INSERT INTO lfitems(item, status, date_time, location, description) VALUES ("' . $item . '" , "' . $status . '", "' . $datetime . '", "' . $location . '", "' . $description . '")' ;
     #show_query($query);

     $results = mysqli_query($dbca, $query) ;
     check_results($results) ;

     return $results ;
}

function insert_admin_record($dbcl, $username, $password) {
     $query = 'INSERT INTO login(username, password) VALUES ("' . $username . '" , "' . $password . '")' ;
     #show_query($query);

     $results = mysqli_query($dbcl, $query) ;
     check_admin_results($results) ;

     return $results ;
}

# Shows the query as a debugging aid
function show_query($query) {
     global $debug;

     if($debug) {
          echo "<p>Query = $query</p>" ;
     }
}

# Checks the query results as a debugging aid
function check_results($results) {
     global $dbca;

     if($results != true) {
          #echo '<p>SQL ERROR = ' . mysqli_error( $dbca ) . '</p>'  ;
     }
}

function check_admin_results($results) {
     global $dbcl;

     if($results != true) {
          #echo '<p>SQL ERROR = ' . mysqli_error( $dbca ) . '</p>'  ;
     }
}




function show_search_records($dbca,$keyword) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;
     

     # Create a query to get the name and price sorted by price
     $searchquery = 'SELECT * from lfitems where (item LIKE  "%' . $keyword . '%"  OR status LIKE "%' . $keyword . '%" )';
     # Execute the query
     $results = mysqli_query($dbca, $searchquery);

     
     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>Check to see if your item is already in the database </strong></p>' ;
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>ID</TH>';
          echo '<TH>Item</TH>';
          echo '<TH>Status</TH>';
          echo '<TH>Date</TH>';
          echo '<TH>Location</TH>';
          echo '<TH>Description</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
                $alink = '<A HREF=alphaitem_catalog.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
               echo '<TR>' ;
               echo '<TD ALIGN=right>' . $alink . '</TD>' ;
               #echo '<TD>' . $row['id'] . '</TD>' ;
               #echo '<TD>' . $row['fname'] . '</TD>' ;
               echo '<TD>' . $row['item'] . '</TD>' ;
               echo '<TD>' . $row['status'] . '</TD>' ;
               echo '<TD>' . $row['date_time'] . '</TD>' ;
               echo '<TD>' . $row['location'] . '</TD>' ;
               echo '<TD>' . $row['description'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}











function Admin_delete_records($dbca,$delete_id) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;
     

     # Create a query to get the name and price sorted by price
     $deletequery = 'DELETE from lfitems where id = "'.$delete_id.'"';
     # Execute the query
     $results = mysqli_query($dbca, $deletequery);

     
     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>The item has been Updated!</strong></p>' ;
         
     }
}


function Admin_claimed_records($dbca,$claimed_id) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;
     

     # Create a query to get the name and price sorted by price
     $updatequery = 'UPDATE lfitems SET status = "Claimed" where id = "'.$claimed_id.'"';
     # Execute the query
     $results = mysqli_query($dbca, $updatequery);

     
}


function show_admin_records($dbcl) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT id, username FROM login ORDER BY id DESC'  ;

     # Execute the query
     $results = mysqli_query( $dbcl , $query ) ;

     
     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>Add, edit or remove admins</strong></p>' ;
          echo '<p>For new admins enter a new user name and password</p>';
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>ID</TH>';
          echo '<TH>Username</TH>';

          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
                
               echo '<TR>' ;
               echo '<TD ALIGN=right>' . $row['id'] . '</TD>' ;
               echo '<TD>' . $row['username'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}
function show_admin_delete_records($dbcl) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;

     # Create a query to get the name and price sorted by price
     $query = 'SELECT id, username FROM login ORDER BY id DESC'  ;

     # Execute the query
     $results = mysqli_query( $dbcl , $query ) ;

     
     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>Remove Admins</strong></p>' ;
         
          echo '<TABLE border="3">';
          echo '<TR>';
          echo '<TH>ID</TH>';
          echo '<TH>Username</TH>';

          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ) {
                
               echo '<TR>' ;
               echo '<TD ALIGN=right>' . $row['id'] . '</TD>' ;
               echo '<TD>' . $row['username'] . '</TD>' ;
               echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
     }
}
function Admin_delete_user($dbcl,$delete_admin_id) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;
     

     # Create a query to get the name and price sorted by price
     $deletequery = 'DELETE from login where id = "'.$delete_admin_id.'"';
     # Execute the query
     $results = mysqli_query($dbcl, $deletequery);

     
     # Show results
     if( $results ) {
          # But...wait until we know the query succeeded before
          # starting the table.
          echo '<p> <strong>Admin has been deleted</strong></p>' ;
          
     }
}

function Admin_update_password($dbcl,$change_id,$new_password) {

     # Connect to MySQL server and the database
     #require( 'includes/connectalpha_db.php' ) ;
     

     # Create a query to get the name and price sorted by price
     $updatequery = 'UPDATE login SET password = "'.$new_password.'" where id = "'.$change_id.'"';
     # Execute the query
     $results = mysqli_query($dbcl, $updatequery);
   }
?>



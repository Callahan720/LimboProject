<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who    Date        Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
<?php

require( 'includes/links.php' ) ;

# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');

# Connect to MySQL server and the database
require( 'includes/admin_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

    $user_name = $_POST['user_name'] ;

    $aid = validate($user_name) ;

    if($aid == -1)
      echo '<P style=color:red>Login failed please try again.</P>' ;

    else      
      echo '<p>Welcome user ' . $aid . '</p>' ;
}

#else if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
#    load('admin.php');
#}

?>


<!-- temp -->
<h1>Admin Home Page</h1>
<h2>Quick Links</h2>
<hr>
<a href="url">Add New Admin</a><br>
<a href="url">Delete Admin User</a><br>
<a href="url">Update Account</a><br>
<a href="url">Change Status of Stuff</a><br>
<a href="url">Delete Stuff</a><br>




</html>
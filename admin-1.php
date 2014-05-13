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

session_start();

require( 'includes/links-admin.php' ) ;

# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');

# Connect to MySQL server and the database
require( 'includes/admin_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {

    $aid = $_GET['id'];

    $user_name = get_username($aid);

    $_SESSION['user_id'] = $aid ;
    
}



?>



<h1>Admin Home Page</h1>
<h2><?php echo '<p>Welcome user ' . $user_name . '</p>' ; ?></h2>
<h2>Quick Links</h2>
<hr>
<a href="admin-adduser.php">Add New Admin</a><br>
<a href="admin-updateuser.php">Change Username</a><br>
<a href="admin-passchange.php">Change Password</a><br>
<a href="admin-deleteuser.php">Delete Admin User</a><br>





</html>
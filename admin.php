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
    $pass = $_POST['pass'] ;

    $aid = validate($user_name , $pass) ;

    if($aid == -1)
      echo '<P style=color:red>Login failed please try again.</P>' ;

    else
      load('admin-1.php', $aid);
}
?>
<!-- Get inputs from the user. -->
<h1>Admin login</h1>
<h4>Please input your username and password</h4>
<form action="admin-1.php" method="POST">
<table>
<tr>
<td>User Name:</td><td><input type="text" name="user_name"></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="pass"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
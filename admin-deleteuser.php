<!--
Authors Kevin Callahan and Nick Russell
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


if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    
    $query_update = 'DELETE FROM users  WHERE user_id = "' . $_SESSION['user_id'] . '"';
    $result_update = mysqli_query($dbc, $query_update);
    echo '<P style=color:red>Delete Successful</P>';
    header('Location: admin.php');            
    
}
# Close the connection
mysqli_close($dbc);

show_change_form() ;

function show_change_form() {
    # Get inputs from the user.
    echo '<h1> Delete Current User </h1>';
    echo '<P style=color:red>Warning this action is not reversible and you will be logged out!</P>';
    echo '<form action="admin-deleteuser.php" method="POST">'; 
    echo '<input type = "submit" value = "Delete">';

    echo '<a href="admin-1.php?id=' . $_SESSION['user_id'] . '">
  <input type="button" value="Cancel" />
</a>';
}

?>
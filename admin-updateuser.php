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
    $new_username = "";
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    
    
    $new_username = $_POST['new_username'];
    
            $query_update = 'UPDATE users SET user_name = "' . $new_username . '" WHERE user_id = "' . $_SESSION['user_id'] . '"';
            $result_update = mysqli_query($dbc, $query_update);
            echo '<P style=color:red>Username Update Successful</P>';
            $new_username = "";
          
}
# Close the connection
mysqli_close($dbc);

show_change_form($new_username) ;

function show_change_form($new_username) {
    # Get inputs from the user.
    echo '<h1> Change Your Username </h1>';
    echo '<form action="admin-updateuser.php" method="POST">';
    echo '<h3> Please enter your new username. </h3>';  
    echo 'New Username: <input type="text" name="new_username" value = "' . $new_username . '"><br>';
    echo '<input type = "submit" value = "Submit">';
}

?>
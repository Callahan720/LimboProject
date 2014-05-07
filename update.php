<!--
Authors Kevin Callahan and Nick Russell
-->
<!DOCTYPE html>
<html>
<?php
require( 'includes/links.php' ) ;


# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');


if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	$id_number = "";
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
	$id_number = $_POST['id_number'];
}

# Close the connection
mysqli_close($dbc);

show_login_form($id_number) ;

function show_login_form($id_number) {
	# Get inputs from the user.
	echo '<h1> Update Stuff Login </h1>';
	echo '<form action="update-1.php" method="GET">';
	echo '<h3> Please enter your update id number. </h3>';  
	echo 'Id Number: <input type="text" name="id_number" value = "' . $id_number . '">';
	echo '<input type = "submit" value = "Submit">';
}

?>


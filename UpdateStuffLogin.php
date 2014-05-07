<!--
Authors Kevin Callahan and Nick Russell
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');

//Initialize president info on a GET
if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	$id_number = "";
	$id_check = "";
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
	$id_number = $_POST['id_number'];
	$id_check = $_POST['id_check'];
	
	if (!valid_number($id_number)) 
		echo '<p style="color:red">Your item could not be found. Please try again. </p>';
<<<<<<< HEAD
<<<<<<< HEAD
	else check_id($id_number, $dbc) ;
=======
	else check_id($id_number, $dbc);
>>>>>>> 4efdbfb921673c845a14b5ffea4cdb3b615450a1
=======
	else check_id($id_number, $dbc);
>>>>>>> 4efdbfb921673c845a14b5ffea4cdb3b615450a1
}

# Close the connection
mysqli_close($dbc);

show_login_form($id_number) ;

function show_login_form($id_number) {
	# Get inputs from the user.
	echo '<h1> Update Stuff Login </h1>';
	echo '<form action="UpdateStuff.php" method="POST">';
	echo '<h2> Please enter your update id number. </h2>';  
	echo 'Id Number: <input type="text" name="id_number" value = "' . $id_number . '">';
	echo '<input type = "submit" value = "Submit">';
}
<<<<<<< HEAD
<<<<<<< HEAD
function check_id($id_number, $dbc) {
	$id_check = ($id_number - 23)/500;
	$query = 'SELECT status, item_name, description, location_id, room, contact_id, email, phone_number
 		 	  FROM stuff
 		 	  WHERE id = id_check' ;
 	
 	$results = mysqli_query( $dbc , $query ) ;
 	
 	#if ($results)  
 	#{
 	#update_stuff(
 
 }
=======

>>>>>>> 4efdbfb921673c845a14b5ffea4cdb3b615450a1
=======

>>>>>>> 4efdbfb921673c845a14b5ffea4cdb3b615450a1
?>


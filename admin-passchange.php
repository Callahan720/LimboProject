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
	$old_password = "";
	$new_password = "";
	$check_pass = "";
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
	
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$check_pass = $_POST['check_pass'];
	
	
	if (!$new_password == $check_pass)
	 echo '<P style=color:red>New passwords are not the same. Please try again.</P>';
	if ($new_password == $old_password)
	 echo '<P style=color:red>Your old and new passwords are the same. Please enter an original new password. </P>';
	else {

		$hashed_pass = sha1($old_password) ; 
		$query = "SELECT user_id FROM users WHERE user_id = " . $_SESSION['user_id'] . " AND pass = '" . $hashed_pass . "'" ; 
		#echo($query);
		$results = mysqli_query($dbc, $query);
		if ($results){
			$query_update = 'UPDATE users SET pass = "' . sha1($new_password) . '" WHERE user_id = "' . $_SESSION['user_id'] . '"';
			$result_update = mysqli_query($dbc, $query_update);
			echo '<P style=color:red>Password Update Successful</P>';
			$old_password = "";
			$new_password = "";
			$check_pass = "";
		}
		else 
			echo '<P style=color:red> Incorrect Old Password </P>';
			
	}
}
# Close the connection
mysqli_close($dbc);

show_change_form($old_password, $new_password, $check_pass) ;

function show_change_form($old_password, $new_password, $check_pass) {
	# Get inputs from the user.
	echo '<h1> Change Your Password </h1>';
	echo '<form action="admin-passchange.php" method="POST">';
	echo '<h3> Please enter your old password as well as a new password. </h3>';  
	echo 'Old Password: <input type="password" name="old_password" value = "' . $old_password . '"><br>';
	echo 'New Password: <input type="password" name="new_password" value = "' . $new_password . '"><br>';
	echo 'Reenter New Password: <input type="password" name="check_pass" value = "' . $check_pass . '"><br>';
	echo '<input type = "submit" value = "Submit">';
}

?>
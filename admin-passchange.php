<!--
Authors Kevin Callahan and Nick Russell
-->
<!DOCTYPE html>
<html>
<?php
session_start();

require( 'includes/links.php' ) ;


# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');


if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	$old_password = "";
	$new_password = "";
	$check_new = "";
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
	
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$check_new = $_POST['check_new'];
	
	
	if ($new_password == $check_new)
	 echo '<P style=color:red>New passwords are not the same. Please try again.</P>';
	else if ($new_password == $old_password)
	 echo '<P style=color:red>Your old and new passwords are the same. Please enter an original new password. </P>'
	else 
	{
		$query = 'SELECT * FROM users WHERE id = ' . $_SESSION['user_id'] . ' AND pass = ' . sha1($old_password);
		$results = mysqli_query($dbc, $query);
		if ($results){
			$query_update = UPDATE users SET pass = sha1($new_password);
			$result_update = mysqli_query($dbc, $query_update);
			if($result_update)
				echo '<P style=color:red>Password Update Successful</P>';
		}
		else 
			echo '<P style=color:red> Incorrect Old Password </P>';
			
	}

# Close the connection
mysqli_close($dbc);

show_change_form($old_password, $new_password, $check_new) ;

function show_change_form($old_password, $new_password) {
	# Get inputs from the user.
	echo '<h1> Change Your Password </h1>';
	echo '<form action="admin-passchange.php" method="GET">';
	echo '<h3> Please enter your old password as well as a new password. </h3>';  
	echo 'Old Password: <input type="text" name="old_password" value = "' . $old_password . '">';
	echo 'New Password: <input type="text" name="new_password" value = "' . $new_password . '">';
	echo 'Reenter New Password: <input type="text" name="check_new" value = "' . $check_new . '">';
	echo '<input type = "submit" value = "Submit">';
}

?>
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
	$username = "";
	$pass = "";
	$check_pass = "";

	if (isset($_GET['add']) && $_GET['add']==1){
		echo '<P style=color:red>Successfully Added an Admin</P>';
	}
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
	
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$check_pass = $_POST['check_pass'];
	
	
	if ($pass != $check_pass)
	 echo '<P style=color:red>Passwords are not the same. Please try again.</P>';
	else 
	{
		$query = 'SELECT * FROM users WHERE user_name = ' . $username;
		$results = mysqli_query($dbc, $query);
		if (!$results){
			$query_insert = 'INSERT INTO users (user_name, pass) 
							 VALUES ("' . $username . '" , "' . sha1($pass) . '")';

			$result_insert = mysqli_query( $dbc, $query_insert ) ;
			
			if($result_insert){
				header('Location: admin-adduser.php?add=1');
			}
		}
		else 
			echo '<P style=color:red> This username already exists. Please try again. </P>';
			
	}
}
# Close the connection
mysqli_close($dbc);

show_add_form($username, $pass, $check_pass) ;

function show_add_form($username, $pass, $check_pass) {
	# Get inputs from the user.
	echo '<h1> Create a New Admin </h1>';
	echo '<form action="admin-adduser.php" method="POST">';
	echo '<h3> Please enter all of the fields and press submit. </h3>';  
	echo 'Username: <input type="text" name="username" value = "' . $username . '"><br>';
	echo 'Password: <input type="password" name="pass" value = "' . $pass . '"><br>';
	echo 'Reenter Password: <input type="password" name="check_pass" value = "' . $check_pass . '"><br>';
	echo '<input type = "submit" value = "Submit">';
}

?>
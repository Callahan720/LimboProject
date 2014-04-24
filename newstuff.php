<!--
Authors Kevin Callahan and Nick Russell
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

//Initialize president info on a GET
if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	$status = "lost";
	$item_name = "" ;
    $description = "";
	$location_id = "" ;
	$room = "" ;
	$contact_id = "" ;
	$email = "";
	$phone_number = "" ;
	
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
	$status = $_POST['status'];

	$item_name = $_POST['item_name'] ;

    $description = $_POST['description'] ;
	
	$location_id = $_POST['location_id'] ;
	
	$room = $_POST['room'] ;
	
	$contact_id = $_POST['contact_id'] ;
	
	$email = $_POST['email'] ;
	
	$phone_number = $_POST['phone_number'] ;
	
	if (!valid_name($item_name)) 
		echo '<p style="color:red">Please give a valid item name. </p>' ;
	else if (!valid_name($location_id)) 
		echo '<p style="color:red">Please give a valid location. </p>' ;
	else if (!valid_name($contact_id)) 
		echo '<p style="color:red">Please give a valid name for your contact information. </p>' ;
	else if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!valid_number($phone_number))) 
		echo '<p style="color:red">Please give either a valid email address or phone number. </p>' ;
	else 
		$results = insert_record($status, $item_name, $description, $location_id, $room, $contact_id, $email, $phone_number) ;
}

# Close the connection
mysqli_close($dbc);

show_form($status, $item_name, $description, $location_id, $room, $contact_id, $email, $phone_number) ;

function show_form($status, $item_name, $description, $location_id, $room, $contact_id, $email, $phone_number) {
	# Get inputs from the user.
	echo '<h1> Lost and Found Stuff </h1>';
	echo '<form action="newstuff.php" method="POST">';
	echo '<table>';
	echo '<tr>';
	echo '<td>I have</td> 
		  <td><select name = "status">
			  <option value = "lost">Lost</option>;
			  <option value = "found">Found</option>
			  </select>
			  </td>
		  <td> an item </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Name of Item: </td> <td><input type="text" name="item_name" value = "' . $item_name . '"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Location of Item:</td> 
		  <td><select name = "location_id">
			  <option value = "Champagnat">Champagnat</option>;
			  <option value = "Leo">Leo</option>
			  <option value = "Sheahan">Sheahan</option>
			  <option value = "Marian">Marian</option>
			  <option value = "Gartland">Gartland</option>
			  <option value = "Midrise">Midrise</option>
			  <option value = "Upper West Cedar">Upper West Cedar</option>
			  <option value = "Talmadge">Talmadge</option>
			  <option value = "Lower Fulton">Lower Fulton</option>
			  <option value = "Upper Fulton">Upper Fulton</option>
			  <option value = "Middle Fulton">Middle Fulton</option>
			  <option value = "Foy Townhouses">Foy Townhouses</option>
			  <option value = "Tennis Courts">Tennis Courts</option>
			  <option value = "Greystone">Greystone</option>
			  <option value = "Tenney Stadium">Tenney Stadium</option>
			  <option value = "St. Anne">St. Anne</option>
			  <option value = "Cornell Boathouse">Cornell Boathouse</option>
			  <option value = "Marist Boathouse">Marist Boathouse</option>
			  <option value = "Student Center">Student Center</option>
			  <option value = "Music Building">Music Building</option>
			  <option value = "Hancock">Hancock</option>
			  <option value = "Donnelly">Donnelly</option>
			  <option value = "Dyson">Dyson</option>
			  <option value = "Fontaine">Fontaine</option>
			  <option value = "Fontaine Annex">Fontaine Annex</option>
			  <option value = "Lowell Thomas">Lowell Thomas</option>
			  <option value = "Jazzmans Cafe">Jazzmans Cafe</option>
			  <option value = "Cabaret">Cabaret</option>
			  <option value = "Library ">Library</option>
			  <option value = "Steel Plant">Steel Plant</option>
			  </select></td>
			<td> Room: </td> <td> <input type="text" name="room" value = "' . $room . '"></td>' ;
	echo '</tr>';
	echo '<tr>';
	echo '<td> Description:  </td>
		  <td> <textarea rows = "5" columns = "50" name = "description" value = "' . $description . '"> </textarea> </td>
		  </tr>';
	echo '</table>';
	echo '<hr>';
	echo '<h1> Contact Information </h1>';
	echo '<table>';
	echo '<tr>';
	echo '<td> Name: </td> 
		  <td> <input type="text" name = "contact_id" value = "'. $contact_id . '"> </td>
		  ';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Email: </td> 
		  <td> <input type="text" name = "email" value = "'. $email . '"> </td>
		  ';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Phone Number: </td> 
		  <td> <input type="text" name = "phone_number" value = "'. $phone_number . '"> </td>
		  ';
	echo '</tr>';
	echo '</table>';
	echo '<input type = "submit" value = "Submit">';
	echo '</form>';
	echo '</html>';
}
?>


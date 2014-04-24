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
	$status = "";
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
else if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	if (isset($_GET['id']))
		show_record($dbc, $_GET['id']);
}

# Show the records
show_link_records($dbc);

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
		  <td colspan = "2"><select name = "status">
			  <option value = "lost">Lost</option>;
			  <option value = "found">Found</option>
			  </select>
			  </td>
		  <td> an item </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Name of Item: </td> <td colspan = "3"><input type="text" name="item_name" value = "' . $item_name . '"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Location of Item:</td> 
		  <td><select name = "location_id">
			  <option value = "Champagnat" <?php if ($location_name ==  "Champagnat") echo ' selected="selected"'; ?> >Champagnat</option>;
			  <option value = "Leo" <?php if ($location_name ==  "Leo") echo ' selected="selected"'; ?> >Leo</option>
			  <option value = "Sheahan" <?php if ($location_name ==  "Sheahan") echo ' selected="selected"'; ?> >Sheahan</option>
			  <option value = "Marian" <?php if ($location_name ==  "Marian") echo ' selected="selected"'; ?> >Marian</option>
			  <option value = "Gartland" <?php if ($location_name == "Gartland") echo ' selected="selected"'; ?> >Gartland</option>
			  <option value = "Midrise" <?php if ($location_name ==  "Midrise") echo ' selected="selected"'; ?> >Midrise</option>
			  <option value = "Upper West Cedar" <?php if ($location_name ==  "Upper West Cedar") echo ' selected="selected"'; ?> >Upper West Cedar</option>
			  <option value = "Talmadge" <?php if ($location_name ==  "Talmadge") echo ' selected="selected"'; ?> >Talmadge</option>
			  <option value = "Lower Fulton" <?php if ($days ==  "Lower Fulton") echo ' selected="selected"'; ?> >Lower Fulton</option>
			  <option value = "Upper Fulton" <?php if ($days ==  "Upper Fulton") echo ' selected="selected"'; ?> >Upper Fulton</option>
			  <option value = "Middle Fulton" <?php if ($days ==  "Middle Fulton") echo ' selected="selected"'; ?> >Middle Fulton</option>
			  <option value = "Foy Townhouses" <?php if ($days ==  "Foy Townhouses") echo ' selected="selected"'; ?> >Foy Townhouses</option>
			  <option value = "Tennis Courts" <?php if ($days ==  "Tennis Courts") echo ' selected="selected"'; ?> >Tennis Courts</option>
			  <option value = "Greystone" <?php if ($days ==  "Greystone") echo ' selected="selected"'; ?> >Greystone</option>
			  <option value = "Tenney Stadium" <?php if ($days ==  "Tenney Stadium") echo ' selected="selected"'; ?> >Tenney Stadium</option>
			  <option value = "St. Anne" <?php if ($days ==  "St. Anne") echo ' selected="selected"'; ?> >St. Anne</option>
			  <option value = "Cornell Boathouse" <?php if ($days == "Cornell Boathouse" ) echo ' selected="selected"'; ?> >Cornell Boathouse</option>
			  <option value = "Marist Boathouse" <?php if ($days ==  "Marist Boathouse") echo ' selected="selected"'; ?> >Marist Boathouse</option>
			  <option value = "Student Center" <?php if ($days ==  "Student Center") echo ' selected="selected"'; ?> >Student Center</option>
			  <option value = "Music Building" <?php if ($days ==  "Music Building) echo ' selected="selected"'; ?> >Music Building</option>
			  <option value = "Hancock" <?php if ($days ==  "Hancock) echo ' selected="selected"'; ?> >Hancock</option>
			  <option value = "Donnelly" <?php if ($days ==  "Donnelly") echo ' selected="selected"'; ?> >Donnelly</option>
			  <option value = "Dyson" <?php if ($days ==  "Dyson") echo ' selected="selected"'; ?> >Dyson</option>
			  <option value = "Fontaine" <?php if ($days ==  "Fontaine") echo ' selected="selected"'; ?> >Fontaine</option>
			  <option value = "Fontaine Annex" <?php if ($days ==  "Fontaine Annex") echo ' selected="selected"'; ?> >Fontaine Annex</option>
			  <option value = "Lowell Thomas" <?php if ($days ==  "Lowell Thomas") echo ' selected="selected"'; ?> >Lowell Thomas</option>
			  <option value = "Jazzmans Cafe" <?php if ($days ==  "Jazzmans Cafe") echo ' selected="selected"'; ?> >Jazzmans Cafe</option>
			  <option value = "Cabaret" <?php if ($days ==  "Cabaret") echo ' selected="selected"'; ?> >Cabaret</option>
			  <option value = "Library " <?php if ($days ==  "Library") echo ' selected="selected"'; ?> >Library</option>
			  <option value = "Steel Plant" <?php if ($days ==  "Steel Plant") echo ' selected="selected"'; ?> >Steel Plant</option>
			  </select></td>
			<td> Room: </td> <input type="text" name="room" value = "' . $room . '"></td>'
	echo '</tr>';
	echo '<tr>';
	echo '<td> Description:  </td>
		  <td> <textarea rows = "10" columns = "30" name = "description" value = "' . $description . '"> </td>
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


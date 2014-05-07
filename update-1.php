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

if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    if (isset($_GET['id_number']) && $_GET['id_number']>522){
        $id_number = $_GET['id_number'] ;
    	$id_check = ($id_number - 23)/500;
        $query = 'SELECT *
 		 	      FROM stuff
 		 	      WHERE id = ' . $id_check ;
 		$results = mysqli_query( $dbc , $query ) ;
        echo $query;
 		if ( $results && is_int($id_check)) {
            if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
    			show_form($dbc, $row['status'], $row['item_name'], $row['description'],
    					  $row['location_id'], $row['room'], $row['contact_name'], 
    					  $row['email'], $row['phone_number'], $id_check) ;
     		}
        }
 		else {
 		#Error message invalid code and pop up link to go back (ideally)
            echo "Invalid Id";
            header('Location: update.php');
            echo('error');
 		}
    }
    else {
        #Error message invalid code and pop up link to go back (ideally)
            echo "Invalid number/ No number";
            header('Location: update.php');
        }
}
 
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $id_check = $_POST['id_check'];

    $status = $_POST['status'];

    $item_name = $_POST['item_name'] ;

    $description = $_POST['description'] ;
    
    $location_id = $_POST['location_id'] ;
    
    $room = $_POST['room'] ;
    
    $contact_name = $_POST['contact_name'] ;
    
    $email = $_POST['email'] ;
    
    $phone_number = $_POST['phone_number'] ;
    
    if (!valid_name($item_name)) 
        echo '<p style="color:red">Please give a valid item name. </p>' ;
    else if (!valid_name($location_id)) 
        echo '<p style="color:red">Please give a valid location. </p>' ;
    else if (!valid_name($contact_name)) 
        echo '<p style="color:red">Please give a valid name for your contact information. </p>' ;
    else if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!valid_name($phone_number))) 
        echo '<p style="color:red">Please give either a valid email address or phone number. </p>' ;
    else 
        $results = update_records($dbc, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number, $id_check) ;
}



# Close the connection
mysqli_close($dbc);



function show_form($dbc, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number, $id_check) {
    # Get inputs from the user.
    echo '<h1> Lost and Found Stuff </h1>';
    echo '<form action="update-1.php" method="POST">';
    echo '<input type="hidden" name="id_check" value = "' . $id_check . '">';
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
    echo '<td>Location of Item:</td>'; 
    echo '<td>';

    show_locations_select($dbc, $location_id);

    echo '</td>
            <td> Room: </td> <td> <input type="text" name="room" value = "' . $room . '"></td>' ;
    echo '</tr>';
    echo '<tr>';
    echo '<td> Description:  </td>
          <td> <textarea rows = "5" columns = "50" name = "description" >' . $description . '</textarea> </td>
          </tr>';
    echo '</table>';
    echo '<hr>';
    echo '<h1> Contact Information </h1>';
    echo '<table>';
    echo '<tr>';
    echo '<td> Name: </td> 
          <td> <input type="text" name = "contact_name" value = "'. $contact_name . '"> </td>
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
    echo '<input type = "submit" value = "Update">';
    echo '</form>';
    echo '</html>';
}

?>



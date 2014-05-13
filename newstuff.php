<!--
Authors Kevin Callahan and Nick Russell
-->
<!DOCTYPE html>
<html>



<?php

require( 'includes/links.php' ) ;
?>
<h3>Input Stuff Information</h3>
<?php

# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');

//Initialize president info on a GET
if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {

    if ( isset($_GET['insert']) ) {
        if ($_GET['insert']==1){
            echo '<P style=color:red>New Item Successfully Added</P>';
        }
    }


    $status = "lost";
    $item_name = "" ;
    $description = "";
    $location_id = "" ;
    $room = "" ;
    $contact_name = "" ;
    $email = "";
    $phone_number = "" ;

    show_form($dbc, FALSE, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number) ;
    
}

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    
    $status = $_POST['status'];

    $item_name = $_POST['item_name'] ;

    $description = $_POST['description'] ;
    
    $location_id = $_POST['location_id'] ;
    
    $room = $_POST['room'] ;
    
    $contact_name = $_POST['contact_name'] ;
    
    $email = $_POST['email'] ;
    
    $phone_number = $_POST['phone_number'] ;
    
    $perform_insert = $_POST['perform_insert'] ;

    if (!valid_name($item_name)) 
        echo '<p style="color:red">Please give a valid item name. </p>' ;
    else if (!valid_name($location_id)) 
        echo '<p style="color:red">Please give a valid location. </p>' ;
    else if (!valid_name($contact_name)) 
        echo '<p style="color:red">Please give a valid name for your contact information. </p>' ;
    else if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!valid_name($phone_number))) 
        echo '<p style="color:red">Please give either a valid email address or phone number. </p>' ;
    else{ 
        echo '<div id="content" style="background-color:#FFFFFF;height:200px;width:270px;float:left;overflow:auto">' ;
        show_record_search($dbc, $status, $item_name);
        echo '</div>' ;
        echo "<br><br><br><br><br><br><br><br><br><br>";
        show_form($dbc, TRUE, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number) ;
        if ($perform_insert){
            $results = insert_record($dbc, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number) ;
            header('Location: newstuff.php?insert=1'); 
        }
    }
}



# Close the connection
mysqli_close($dbc);



function show_form($dbc, $perform_insert, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number) {
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
    echo '<input type="hidden" name = "perform_insert" value = "'. $perform_insert . '">';
    echo '<input type = "submit" value = "Submit">';
    echo '</form>';
    echo '</html>';
}
?>


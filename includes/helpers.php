<?php
#Authors Kevin Callahan and Nick Russell
$debug = true;

#needed for Limbo
function show_record_recent($dbc, $days = 7) {
    # Create a query to get the name and number sorted by number
    $query = 'SELECT DATE(create_date) AS create_date, status, item_name, id FROM stuff WHERE status!="claimed" AND ABS(DATEDIFF(CURDATE(), create_date)) <= ' . $days ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    

    # Show results
    if( $results )
    {
      # But...wait until we know the query succeeded before
      # starting the table.
      echo '<TABLE border="1">';
      echo '<TR>';
      echo '<TH>Date</TH>';
      echo '<TH>Status</TH>';
      echo '<TH>Stuff</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        echo '<TR>' ;
        echo '<TD>' . $row['create_date'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;

        $alink = '<A HREF=limbo.php?id=' . $row['id'] . '>' . $row['item_name'] . '</A>' ;
        echo '<TD>' . $alink . '</TD>' ;


        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    else
    {
      # If we get here, something has gone wrong
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
    }
}

#needed for Limbo
function show_record_detailed($dbc, $id) {
    # Create a query to get the name and number sorted by number
    $query = 'SELECT DATE(stuff.create_date) AS create_date, extract(HOUR FROM stuff.create_date) AS create_time_hour, extract(MINUTE FROM stuff.create_date) AS create_time_minute, stuff.status, stuff.location_id, stuff.item_name, stuff.id, stuff.room, locations.name FROM stuff, locations WHERE stuff.location_id=locations.id AND stuff.id = ' . $id ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    

    # Show results
    if( $results )
    {
      # But...wait until we know the query succeeded before
      # starting the table.
      
      

      # For each row result, generate a table row
      if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
      	echo '<TABLE border="0">';
		    echo '<TR>';
        echo '<TH ALIGN="Center">' . $row['item_name'] . '</TH>' ;
        echo '</TR>';

        echo '<TR>' ;
        echo '<TD>' . 'Date Reported: ' . $row['create_date'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Time Reported: ' . $row['create_time_hour'] . ':' . $row['create_time_minute'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . $row['status'] . ' in: ' . $row['name'] . ' ' . $row['room'] .  '</TD>' ;
        echo '</TR>';

        $alink = '<A HREF=ql.php?id=' . $row['id'] . '>' . 'Full Description/ Contact Info' . '</A>' ;
        echo '<TD>' . $alink . '</TD>' ;


        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    else
    {
      # If we get here, something has gone wrong
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
    }
}

#needed for Limbo
function show_record_detailed_full($dbc, $id) {
    # Create a query to get the name and number sorted by number
    $query = 'SELECT DATE(stuff.create_date) AS create_date, extract(HOUR FROM stuff.create_date) AS create_time_hour, extract(MINUTE FROM stuff.create_date) AS create_time_minute, stuff.status, stuff.location_id, stuff.item_name, stuff.id, stuff.room, stuff.description, stuff.contact_name, stuff.email, stuff.phone_number, locations.name FROM stuff, locations WHERE stuff.location_id=locations.id AND stuff.id = ' . $id ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    

    # Show results
    if( $results )
    {
      # But...wait until we know the query succeeded before
      # starting the table.
      
      

      # For each row result, generate a table row
      if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
      	echo '<TABLE border="0">';
		    echo '<TR>';
        echo '<TH>' . $row['item_name'] . '</TH>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Status: ' . $row['status'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Date Reported: ' . $row['create_date'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Time Reported: ' . $row['create_time_hour'] . ':' . $row['create_time_minute'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . $row['status'] . ' in: ' . $row['name'] . ' ' . $row['room'] .  '</TD>' ;
        echo '</TR>';
		echo '<TR>' ;
        echo '<TD>' . 'Item Description: ' . $row['description'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD><b>Contact Infomation: </b></TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Name: ' . $row['contact_name'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Email: ' . $row['email'] . '</TD>' ;
        echo '</TR>';
        echo '<TR>' ;
        echo '<TD>' . 'Phone Number: ' . $row['phone_number'] . '</TD>' ;
        echo '</TR>';


      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    else
    {
      # If we get here, something has gone wrong
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
    }
}


# Inserts a record into the prints table
function insert_record($dbc, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number) {
  $query = 'INSERT INTO 
        stuff(status, item_name, description, location_id, room, contact_name, email, phone_number) 
        VALUES ("' . $status . '" , 
            "' . $item_name . '" , 
            "' . $description . '" , 
            "' . $location_id . '" , 
            "' . $room . '" ,  
            "' . $contact_name . '" ,  
            "' . $email . ' " , 
            "' . $phone_number . ' " )' ;
  
  show_query($query);
  
  
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}


#needed for Limbo
function show_locations_select($dbc) {
    # Create a query to get the name and number sorted by number
    $query = 'SELECT id, name FROM locations ';

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    

    # Show results
    if( $results )
    {
      # But...wait until we know the query succeeded before
      # starting the table.
      echo '<select name = "location_id" >' ;
      

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
        echo '<option value = "' . $row['id'] . '">' . $row['name'] . '</option>';
      }

      echo '</select>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
    }
    else
    {
      # If we get here, something has gone wrong
      echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
    }
}


function valid_name ($name){
if (empty($name)){
    return false ;
}

return true;
}

function valid_number ($number){
if (empty($number) || !is_numeric($number))
    return false ;
else {
    $number = intval($number) ; 
    if ($number <= 0)
        return false;
    }
return true ;    
}
# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}
?>
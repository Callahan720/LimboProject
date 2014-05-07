<?php
#Authors Kevin Callahan and Nick Russell
$debug = true;


function init($dbname){
    # Connect to the database, if we fail assume the DB doesnt exist
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname );

    if($dbc) {
        mysqli_set_charset( $dbc, 'utf8' ) ;

        return $dbc;
    }

    $dbc = @mysqli_connect ( 'localhost', 'root', '', '' );

    $query = 'CREATE DATABASE ' . $dbname;

    $results = mysqli_query($dbc, $query);
    check_results($results);

    # Close connection since we dont need it
    mysqli_close( $dbc );

    # Connect to the (newly created) database
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname )
        OR die ( mysqli_connect_error() ) ;

    # Set encoding to match PHP script encoding.
    mysqli_set_charset( $dbc, 'utf8' ) ;

    $sql= file_get_contents('insert_data.sql');
    $results = mysqli_multi_query($dbc, $sql);
    mysqli_close( $dbc );

    # Ggives mysql some time to run through all the queries
    # If the database needs more time to load, then there are probably other problems with the computer
    sleep(1);

    # Recursive so I can guarantee a working connection
    return init($dbname);
}

#needed for Limbo
function show_record_recent($dbc, $days = 7) {
    # Create a query to get the name and number sorted by number
    $query = 'SELECT DATE(create_date) AS create_date, status, item_name, id FROM stuff WHERE status!="claimed" AND ABS(DATEDIFF(CURDATE(), create_date)) <= ' . $days . ' ORDER BY create_date DESC' ;

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


# Inserts a record into the stuff table
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

function update_records($dbc, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number, $id) {
  $query = "";
  $queryUpdate = 'UPDATE stuff SET status = " '. $status . ' " , 
                     item_name = "' . $item_name . '" , 
                     description = "' . $description . '" , 
                     location_id = "' . $location_id . '" , 
                     room = "' . $room . '" ,  
                     contact_name = "' . $contact_name . '" ,  
                     email = "' . $email . ' " , 
                     phone_number = "' . $phone_number . ' " WHERE id = " ' . $id . '  "';
  
  show_query($queryUpdate);
  
  
  $results = mysqli_query( $dbc , $queryUpdate ) ;
  check_results($results) ;

  return $results ;
}



#needed for Limbo
function show_locations_select($dbc, $id) {
    # Create a query to get the name and number sorted by number
    $query = 'SELECT id, name FROM locations ORDER BY name ';

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
        $temp_id = $row['id'] ;
        
        if ($id ==  $temp_id){ 
          echo '<option value = "' . $temp_id . '" selected="selected">' . $row['name'] . '</option>' ;
        }
        else{
          echo '<option value = "' . $temp_id . '">' . $row['name'] . '</option>' ;
        }
        
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
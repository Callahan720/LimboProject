<?php
#Authors Kevin Callahan and Nick Russell
$debug = true;

# Shows the records in prints
function show_records($dbc) {
	# Create a query to get the name and number sorted by number
	$query = 'SELECT number, fname, lname FROM presidents ORDER BY number DESC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;

	# Show results
	if( $results )
	{
	  # But...wait until we know the query succeeded before
	  # starting the table.
	  echo '<H1>Dead Presidents</H1>' ;
	  echo '<TABLE border="1">';
	  echo '<TR>';
	  echo '<TH>Number</TH>';
	  echo '<TH>First Name</TH>';
	  echo '<TH>Last Name</TH>';
	  echo '</TR>';

	  # For each row result, generate a table row
	  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
	  {
		echo '<TR>' ;
		echo '<TD>' . $row['number'] . '</TD>' ;
		echo '<TD>' . $row['fname'] . '</TD>' ;
		echo '<TD>' . $row['lname'] . '</TD>' ;
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

function show_record($dbc, $id) {
	# Create a query to get the name and number sorted by number
	$query = 'SELECT number, lname, fname FROM presidents WHERE number = ' . $id ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	

	# Show results
	if( $results )
	{
	  # But...wait until we know the query succeeded before
	  # starting the table.
	  echo '<H1>Dead Presidents</H1>' ;
	  echo '<TABLE border="1">';
	  echo '<TR>';
	  echo '<TH>Number</TH>';
	  echo '<TH>First Name</TH>';
	  echo '<TH>Last Name</TH>';
	  echo '</TR>';

	  # For each row result, generate a table row
	  if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
	  {
		echo '<TR>' ;
		echo '<TD>' . $row['number'] . '</TD>' ;
		echo '<TD>' . $row['fname'] . '</TD>' ;
		echo '<TD>' . $row['lname'] . '</TD>' ;
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

function show_link_records($dbc) {
	# Create a query to get the name and number sorted by number
	$query = 'SELECT number, lname FROM presidents ORDER BY number DESC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;

	# Show results
	if( $results )
	{
	  # But...wait until we know the query succeeded before
	  # starting the table.
	  echo '<H1>Dead Presidents</H1>' ;
	  echo '<TABLE border="1">';
	  echo '<TR>';
	  echo '<TH>Number</TH>';
	  echo '<TH>Last Name</TH>';
	  echo '</TR>';

	  # For each row result, generate a table row
	  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
	  {
		$alink = '<A HREF=linkypresidents.php?id=' . $row['number'] . '>' . $row['number'] . '</A>' ;
		echo '<TR>' ;
		echo '<TD ALIGN = right>' . $alink . '</TD>' ;
		echo '<TD>' . $row['lname'] . '</TD>' ;
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

# Inserts a record into the prints table
function insert_record($status, $item_name, $description, $location_id, $room, $contact_id, $email, $phone_number) {
  $query = 'INSERT INTO 
  			stuff(status, item_name, description, location_id, room, contact_id, email, phone_number) 
  			VALUES ("' . $status . '" , 
  					"' . $item_name . '" , 
  					"' . $description . '" , 
  					"' . $location_id . '" , 
  					"' . $room . '" ,  
  					"' . $conact_id . '" ,  
  					"' . $email . '" , 
  					' . $phone_number . ' )' ;
  
  show_query($query);
  
  
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

function valid_name ($name){
if (empty($name) || !ctype_alpha($name)){
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
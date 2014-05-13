<!--
This file contains PHP login helper functions.
Orginally created by Ron Coleman.
History:
Who	Date		Comment
RC	 7-Nov-13	Created.
-->
<?php

# Loads a specified or default URL.
function load( $page = 'admin-1.php', $aid = -1 )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL and the print id.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page . '?id=' . $aid ;

  # Execute redirect then quit.
  session_start( );

  header( "Location: $url" ) ;

  exit() ;
}

# Validates the print name.
# Returns -1 if validate fails, and >= 0 if it succeeds
# which is the primary key id.
function validate($user_name = '', $pass = '')
{
    global $dbc;

    if(empty($user_name) && empty($pass))
      return -1 ;

    # Make the query
    $hashed_pass = sha1($pass) ; 
    $query = "SELECT user_id, user_name, pass FROM users WHERE user_name= '" . $user_name . "' AND pass= '" . $hashed_pass . "'" ; 
    show_query($query) ; 

    # Execute the query
    $results = mysqli_query( $dbc, $query ) ;
    check_results($results);

    # If we get no rows, the login failed
    if (mysqli_num_rows( $results ) == 0 )
      return -1 ;

    # We have at least one row, so get the first one and return it
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;

    $aid = $row [ 'user_id' ] ;

    return intval($aid) ;
}

function get_username($aid = '')
{
    global $dbc;

    if(empty($aid))
      return -1 ;

    # Make the query 
    $query = "SELECT user_name FROM users WHERE user_id= '" . $aid . "'" ; 
    #show_query($query) ; 

    # Execute the query
    $results = mysqli_query( $dbc, $query ) ;
    check_results($results);

    # If we get no rows, the login failed
    if (mysqli_num_rows( $results ) == 0 )
      return -1 ;

    # We have at least one row, so get the first one and return it
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;

    $user_name = $row [ 'user_name' ] ;

    return $user_name ;
}
?>
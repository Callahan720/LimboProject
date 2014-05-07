<!DOCTYPE html>
<html>

<style>
table,th,td
{
border:1px solid black;
border-collapse:collapse;
}
</style>
</head>

<?php  
require( 'includes/links.php' ) ;
?>

<h1>Full Description</h1>

<?php   
# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');


if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    if (isset($_GET['id'])){
        show_record_detailed_full($dbc, $_GET['id']);
    }
}



?>







</html>
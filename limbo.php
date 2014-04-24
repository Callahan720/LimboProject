<!DOCTYPE html>
<html>

<style>
table,th,td
{
border:2px solid black;
border-collapse:collapse;
}
</style>
</head>

<h1>Welcome to Limbo!</h1>
<h4>If you lost or found something, you're in luck: this is the place to report it.</h4>

<p>Reported in last:</p>
<form action="limbo.php" method="POST">
<select onchange="this.form.submit()">
  <option value="7">7 Days</option>
  <option value="14">2 Weeks</option>
  <option value="21">3 Weeks</option>
  <option value="31">Month</option>
</select>
</form>


<?php   
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

show_record_recent($dbc,7);

}

?>







</html>
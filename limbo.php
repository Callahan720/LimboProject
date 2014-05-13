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

<?php  
require( 'includes/links.php' ) ;
?>

<h1>Welcome to Limbo!</h1>
<h4>If you lost or found something, you're in luck: this is the place to report it.</h4>

<p>Reported in last:</p>

<?php
if (isset($_POST['days'])){
        $days = $_POST['days'] ;
    }
else{
    $days = 0 ;
}
?>

<form action="limbo.php" method="POST">
<select name="days" onchange="this.form.submit()">
 <option value="7"  <?php if ($days ==  7) echo ' selected="selected"'; ?> >7 Days</option>
 <option value="14" <?php if ($days == 14) echo ' selected="selected"'; ?> >2 Weeks</option>
 <option value="21" <?php if ($days == 21) echo ' selected="selected"'; ?> >3 Weeks</option>
 <option value="31" <?php if ($days == 31) echo ' selected="selected"'; ?> >Month</option>
 <option value="60" <?php if ($days == 60) echo ' selected="selected"'; ?> >2 Months</option>
 <option value="90" <?php if ($days == 90) echo ' selected="selected"'; ?> >3 Months</option>
</select>
</form>


<?php   

# Connect to MySQL server and the database
require( 'includes/helpers.php' ) ;

# Initialize the database
$dbc = init('limbo_db');

echo '<div id="content" style="background-color:#FFFFFF;height:218px;width:250px;float:left;overflow:auto">' ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    #$days = "" ; 
    $item_id = "" ;

    if (isset($_POST['days'])){
        $days = $_POST['days'] ;
        show_record_recent($dbc, $days);
    }
    else{
        show_record_recent($dbc);
    }
    
}


if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $days = $_POST['days'] ;



    show_record_recent($dbc, $days);

}
echo '</div>' ;

echo '<div id="content2" style="background-color:#FFFFFF;height:200px;width:400px;float:left;overflow:auto">' ;

if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    if (isset($_GET['id'])){
        show_record_detailed($dbc, $_GET['id']);
    }
}

echo '</div>' ;


?>







</html>
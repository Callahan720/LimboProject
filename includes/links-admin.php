<?php


    echo '<a href="limbo.php">Home</a> &nbsp;&nbsp;' ;
    echo '<a href="newstuff.php">Add New Item</a> &nbsp;&nbsp;' ;
    echo '<a href="update.php">Update Item</a> &nbsp;&nbsp;' ;

    echo '<a href="admin-1.php?id=' . $_SESSION['user_id'] . '">Admin Home</a> &nbsp;&nbsp;' ;

    echo '<a href="admin.php">Logout</a> &nbsp;&nbsp;' ;

?>
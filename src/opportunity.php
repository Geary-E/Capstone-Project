<?php
//PHP coded by Jeremy Tollison

//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();
?>

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<head>
        
    <?php //Prints meta data
    meta(); ?>
    
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="container">
        <div class="content">
            <h1>Hello <span><?php echo $name ?></span> this is the Opportunities section.</h1>
            <a href="logout.php" class="btn"> Logout</a>
        </div>
    </div>
</body>

</html>
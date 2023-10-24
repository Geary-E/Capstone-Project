<?php
//PHP coded by Jeremy Tollison

//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php //Prints meta data
    meta(); ?>

    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="generalStyle.css">
    <title>manageSurvey</title>
</head>

<body>
    <?php pageHeader(); //Displays the header
    ?>
    <h1>Hello <span><?php echo $name ?></span> this is the manage survey section</h1>
</body>
</html>
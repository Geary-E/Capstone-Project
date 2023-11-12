<?php
//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();
$userID=userID();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php meta(); ?> <!--Prints meta data-->

    <link rel="stylesheet" href="generalStyle.css">
    <title>StudiesEdit</title>
</head>

<body>
    <?php
        $pageName = 'StudiesEdit';
        pageHeader(); //Displays the header
        pageNavbar($conn, $pageName, $name, $userID); //Displays the navbar
    ?>
</body>
</html>
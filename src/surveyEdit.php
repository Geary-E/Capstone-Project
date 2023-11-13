<?php
//PHP coded by Jeremy Tollison

//Include config file for database connection and functions
@include 'config.php';


//Start the session
session_start();


//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();
$userID=userID();
?>

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<head>

    <?php meta(); ?> <!--Prints meta data-->

    <link rel="stylesheet" href="generalStyle.css">
    <title>SurveysEdit</title>
</head>

<body>
    <?php
        $pageName = 'SurveysEdit';
        pageHeader(); //Displays the header
        pageNavbar($conn, $pageName, $name, $userID); //Displays the navbar
    ?>
</body>
</html>
<?php
//PHP coded by Jeremy

//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();
$userID=userID();
//$first_name = firstNameType();
//$last_name = lastNameType();
//$email=emailType();
//$user_type=userType();
?>

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<head>

    <?php //Prints meta data
    meta(); ?>

    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="generalStyle.css">
    <title>accountPage</title>
</head>

<body>
    <?php pageHeader(); //Displays the header
    $pageName = 'Account Page';

    pageNavbar($conn, $pageName, $name, $userID); 

   /* accountPageDisplay($name, $email, $user_type);*/
    ?>
</body>
</html>
<?php
//PHP coded by Jeremy Tollison

//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Clear the session data
session_unset();

//Destroy the session
session_destroy();

// Redirect the user to the login page
header('location:index.php');
?>
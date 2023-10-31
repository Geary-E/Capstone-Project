<?php
//PHP coded by Jeremy
$dbServerName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'user_db';

//Creates conn variable which connects to the user_db
$conn = mysqli_connect($dbServerName,$dbUsername,$dbPassword,$dbName);
?>
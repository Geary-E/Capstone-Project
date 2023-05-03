<?php

//Include database connection file
@include 'config.php';

//Start the session
session_start();

//If researcher_name is set make it name
if (isset($_SESSION['researcher_name'])) {
    $name = $_SESSION['researcher_name'];
}

//If person_name is set make it name
elseif (isset($_SESSION['person_name'])) {
    $name = $_SESSION['person_name'];
}


//Sends user to accountPage.php
if (isset($_POST['Account_Page'])) {
    header('location:accountPage.php');
}

//Sends user to supportGroup.php
if (isset($_POST['Support_Groups'])) {
    header('location:supportGroup.php');
}

//Sends user to surveys.php
if (isset($_POST['Surveys'])) {
    header('location:surveys.php');
}

//Sends user to studies.php
if (isset($_POST['Studies'])) {
    header('location:studies.php');
}

//Sends user to opportunities.php
if (isset($_POST['Opportunities'])) {
    header('location:opportunities.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Dashboard</title>
</head>

<body>
<!--
    <div class="container">
-->
        <div class="dashboard-header">
            <div class="logo">
               <h2> Logo </h2> 
            </div>
            <div class="buttons">
                <button class="btn1"> Dashboard </button>
                <button class="btn2"> Logout </button>
            </div>
        </div>

<!--</span> -->
            <h1> Hello <span><?php echo"$name, Welcome to the Dashboard."?></h1><br>
            
            <!--
            <a href="logout.php" class="btn"> Logout</a>
            -->

    	<div class="content">
    		<form action="" method="post">
            	<div class="flex1">
            		 <a href="accountPage.php" class="btn2"> Account Page</a>
            	</div>

            	<div class="flex2">
                	<a href="supportGroup.php" class="btn2"> Support Groups</a>
            	</div>
            
            	<div class="flex3">
                	<a href="survey.php" class="btn2"> Surveys</a> 
            	</div>

            	<div class="flex4">
                	<a href="studies.php" class="btn2"> Studies</a>  
            	</div>

            	<div class="flex5">
                	<a href="opportunities.php" class="btn2"> Opportunities</a>
            	</div>

        </div>

</body>


</html>
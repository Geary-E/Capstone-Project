<?php

@include 'config.php';

session_start();


if (isset($_SESSION['researcher_name'])) {
    $name = $_SESSION['researcher_name'];
}

if (isset($_SESSION['person_name'])) {
    $name = $_SESSION['person_name'];
} else {
    $name = "______";
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
            <div class="flex1">
                Account Page
                </div>

            <div class="flex2">
                Support Groups
            </div>
            
            <div class="flex3">
                Surveys
            </div>

            <div class="flex4">
                Studies
            </div>

            <div class="flex5">
                Opportunities
            </div>

        </div>

</body>

</html>
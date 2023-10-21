<?php
//PHP coded by Jeremy

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

    <link rel="stylesheet" href="style3.css">
    <title>Dashboard</title>
</head>

<body>
    
    <?php pageHeader(); 
    ?>

            <!-- Welcoming person to the dashboard -->
            <h1>Hello <span><?php echo $name ?></span> welcome to the Dashboard.</h1><br>

    	<div class="content">
      
            	<a class="flex1" href="accountPage.php">  <!-- Account Page button -->
            		 Account Page 
                </a>

            <a class="flex2" href="supportGroup.php">  <!-- Support Group button -->
                Support Groups
                </a>

            <a class="flex3" href="survey.php">   <!-- Survey button -->
                Surveys
                </a>

            <a class="flex4" href="study.php">  <!-- Studies button -->
                Studies
                </a>	

            <a class="flex5" href="opportunity.php">  <!-- Opportunities button -->
                Opportunities
                </a>	

        </div>

</body>

</html>
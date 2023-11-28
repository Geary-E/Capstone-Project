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
    <link rel="stylesheet" href="generalStyle.css">
    <title>dashboard</title>
</head>

<body>
    <?php pageHeader(); //Displays the header
    ?>
    <h1>Hello <span><?php echo $name ?></span> welcome to the dashboard</h1><br>

    <div class="content">
      
        <a class="flex1" href="accountPage.php">  <!-- Account Page button -->
            <img class="user-account-pic" src="./images/account_pic.png" alt="User Account"><br><br> <!-- Image associated with account settings -->
            Account Page 
        </a>

        <a class="flex2" href="supportGroup.php">  <!-- Support Group button -->
            <img class="support-group-pic" src="./images/support_group_pic.jpg" alt="Support Groups"><br><br> <!-- Image associated with support groups -->
            Support Groups
        </a>

        <a class="flex3" href="survey.php">   <!-- Survey button -->
            <img class="survey-pic" src="./images/surveys.png" alt="Surveys"><br><br> <!-- Image associated with surveys -->
            Surveys
        </a>

        <a class="flex4" href="study.php">  <!-- Studies button -->
            <img class="studies-pic" src="./images/studies.png" alt="Studies"><br><br> <!-- Image associated with studies -->
            Studies
        </a>	

        <a class="flex5" href="opportunity.php">  <!-- Opportunities button -->
            <img class="opportunity-pic" src="./images/opportunities_pic.png" alt="Opportunities"><br><br> <!-- Image associated with opportunities -->
            Opportunities
        </a>	
    </div>
</body>
</html>
<?php
//PHP coded by Jeremy Tollison

//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();

    //PHP added by Connor
	//accessing the study_form database
	$sql = 'SELECT * FROM study_form';
	$query = mysqli_query($conn,$sql);
?>

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<head>

    <?php //Prints meta data
    meta(); ?>

    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="generalStyle.css">
    <title>manageStudy</title>
</head>

<body>
    <?php pageHeader(); //Displays the header
    ?>    
    <style>

            .content {
                display: flex;
                padding: 0px;
                justify-content: center;
                align-items: flex-start;
                height: 80vh;
            }

            .create-section {
                margin: 0;
                flex: 20;
                background-color:#00853E;
                color: white;
                padding: 30px;
                height: 100vh;
            }

            .create {
                padding: 40px;
                font-size: 30px;
                margin: 0;
                height: 50px;
                width: 75%;
            }

            .create a {
                text-decoration: none;
            }

            .create a:visited {
                color: white;
            }

            .create:hover {
                background-color: white;
                color: #00853E;
            }

            .create:hover, .create a:hover {
                color:#00853E;
            }

           
            .study-section {
                flex: 80;
                padding: 30px;
                height: 100vh;
            }

            .search-section {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

            .search-bar, .tag-bar {
                padding: 10px;
                }

            label {
                font-size: 20px;
                }

            input {
                border: solid 1px black;
                font-size: 15px;
                border-radius: 20%;
                padding: 10px;
            }

            .flex-1, .flex-2, .flex-3 {
                display: block;
                margin: auto;
                padding: 20px;
                font-size: 20px;
                cursor: pointer;
                width: 50%;
                border: solid 1px black;
                color:#00853E; 
                text-align: center;
            }

            .flex-1:hover, .flex-2:hover, .flex-3:hover {
                background-color:#00853E;
                color: white;
            }

            .button-list {
                padding: 10px;
                margin: auto;
                text-align: center;
            }

            .hover-buttons {
                cursor: pointer;
                padding: 20px;
                color:#00853E;
                font-size: 15px;
                border: solid 1px black;
                border-radius: 25%;
                background-color: white;
            }

            .hover-buttons:hover {
                background-color:#00853E;
                color: white;
            }

            .load-more {
                    display: block;
                    cursor: pointer;
                    margin: auto;
                    font-size: 15px;
                    text-decoration: none;
                    text-align: center;
                    padding: 15px;
                    border: solid 1px black;
                    width: 50%;
                    color: #00853E;
                }

                .load-more:hover {
                    background-color: #00853E;
                    color: white;
                }    


        </style>
</head>

<body>

    <div class="container">



        <div class="content">

            <div class="create-section">
                <div class="create"> 
                    <a href="studiesCreate.php">Create Study</a> </div>
            </div>

            <div class="study-section">

            <h1 style="text-align: center; color: #00853E"> Hello <span><?php echo"$name, Welcome to the Manage Study Section"?></h1>
            
                <div class="search-section">
                        <p style="display: block;">Search By:</p> <br><br>
                        <div class="search-bar"><span><label for="search">Name:</label><input type="text" id="search"  name="search"></span></div>
                        <div class="tag-bar"><span><label for="tag"> Tags:</label><input type="text" id="tag" name="tags"></span></div>
                    </div><br>

                <div class="flex-1"> Study </div>
                <div class="button-list">
                <button class="hover-buttons"> Edit </button> <button class="hover-buttons"> Delete </button></div>
                 <br>

                <div class="flex-2">  Study </div>
                <div class="button-list">
                <button class="hover-buttons"> Edit </button> <button class="hover-buttons"> Delete </button></div>
                <br>
            
                <div class="flex-3"> Study </div>
                <div class="button-list">
                <button class="hover-buttons"> Edit </button> <button class="hover-buttons"> Delete </button></div>
                <br>
            
                <button class="load-more"> Load More </button><br>
            <div>
        </div>
    </div>
</body>

</html>
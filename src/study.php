<?php
//PHP coded by Jeremy Tollison

//Include config file for database connection and functions
@include 'config.php';

//Start the session
session_start();

//Used to set name variable based on user_type stored in $_SESSION
$name=nameType();
?>

<!DOCTYPE html> <!--HTML coded by Geary & Connor -->
<html lang="en">

<head>
        
    <?php //Prints meta data
    meta(); ?>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="generalStyle.css">
    <title>Study</title>
</head>

<body>
<?php pageHeader(); //Displays the header
    ?>

 <div class="container">

        <div class="content">

        <div class="my-studies">
            <div class="little-section">
                My Studies 
                </div><br><br>
                <div class="second-section">
                    <a href="manageStudy.php">Manage Studies</a>
                </div>
            </div>

            <div class="study-series">

            <h1 style="text-align: center; color: #00853E"> Hello <span><?php echo"$name, Welcome to the Studies Section."?></h1><br>
            
                <div class="search-section">
                    <p style="display: block;">Search By:</p> <br><br>
                    <div class="search-bar"><span><label for="search">Name:</label><input type="text" id="search"  name="search"></span></div>
                    <div class="tag-bar"><span><label for="tag"> Tags:</label><input type="text" id="tag" name="tags"></span></div>
                </div><br>

                <a class="study1" href="#study1"> Study </a><br> <!-- originally divs -->
                <a class="study2" href="#study2"> Study </a><br>
                <a class="study3" href="#study3"> Study </a> <br>
                <a class="study4" href="#study4"> Study </a> <br>
                <a class="study5" href="#study5"> Study </a><br>
                <button class="load-more"> Load More </button><br>

         		
				<!--Temporary code to test/show all the data from the study_form database
				<?php
                        $pageName = 'Studies';
					echo "<table class='table'>
					<tr>
					<th>Study Name</th>
					<th>Study Description</th>
					</tr>";
					
					while ($row = mysqli_fetch_array($query)){
						echo " <tr>
						<td>{$row['study_name']}</td>
						<td>{$row['study_desc']}</td>
						</tr>";
					}
					echo "</table>";
				?>
				<br>
				-->

            </div>

			
         </div>
    </div>
</body>

</html>
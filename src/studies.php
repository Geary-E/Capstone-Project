<?php
@include 'config.php';

session_start();

//If researcher_name is set make it name
if (isset($_SESSION['researcher_name'])) {
    $name = $_SESSION['researcher_name'];
}

//If person_name is set make it name
elseif (isset($_SESSION['person_name'])) {
    $name = $_SESSION['person_name'];
}

	//accessing the study_form database
	$sql = 'SELECT * FROM study_form';
	$query = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style4.css">
    <title>Studies</title>
</head>

<body>

 <div class="container">

        <div class="top-header">
            <p style="display: inline-block;text-align:center;">Studies</p>
            <button class="logout-btn" onClick="window.location.href='logout.php'">Log Out</button>
        </div><br>

        <div class="content">

        <div class="my-studies">
            <div class="little-section">
                My Studies 
                </div><br><br>
                <div class="second-section">
                <?php
                if (isset($_SESSION['researcher_name'])) {
                echo '<a href="manageStudies.php">Manage Studies</a>';
                }
                ?>
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

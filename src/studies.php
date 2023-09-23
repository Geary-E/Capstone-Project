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
            Studies
        </div><br>

        <div class="content">

        <div class="my-studies">
            <div class="little-section">
                My Studies 
                </div>
            </div>

            <div class="study-series">

            <h1 style="text-align: center; color: #00853E"> Hello <span><?php echo"$name, Welcome to the Studies Section."?></h1><br>
            

                <a class="study1" href="#study1"> Study </a><br> <!-- originally divs -->
                <a class="study2" href="#study2"> Study </a><br>
                <a class="study3" href="#study3"> Study </a> <br>
                <a class="study4" href="#study4"> Study </a> <br>
                <a class="study5" href="#study5"> Study </a><br>
                <button class="load-more"> Load More </button>
                <!-- <a class="study5" href="#study5"> Study </a> -->

            </div>

           
         </div>

    </div>
</body>

</html>

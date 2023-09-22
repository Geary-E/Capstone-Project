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
            

                <div class="study1"><a class="links" href="#study1"> Study </a></div><br> <!-- originally divs -->
                <div class="study2"><a class="links" href="#study2"> Study </a></div><br>
                <div class="study3"><a class="links" href="#study3"> Study</a></div><br>
                <div class="study4"><a class="links" href="#study4"> Study </a></div><br>
                <div class="study5"><a class="links" href="#study5"> Study </a></div><br>

            </div>

           
         </div>

    </div>
</body>

</html>

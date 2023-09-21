<?php
@include 'config.php';

session_start();

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
        </div>

        <div class="content">

            <div class="my-studies">
                My Studies 
            </div>

            <!--
            <h1>Hello <span><?php echo"$name"?></span>, this is the Studies section</h1>
            <a href="logout.php" class="btn"> Logout</a>
            <br>
-->

            <div class="study-series">

            <h1 style="text-align: center">Hello <span><?php echo"$name"?></span>, this is the Studies section</h1>
            <a href="logout.php" class="btn"> Logout</a>
            <br>

                <div class="study1"> Study </div>
                <div class="study2"> Study </div>
                <div class="study3"> Study </div>
                <div class="study4"> Study </div>
                <div class="study5"> Study </div>

            </div>
         </div>
    </div>
</body>

</html>

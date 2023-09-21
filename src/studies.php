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
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="container">
        <div class="content">
            <h1>Hello <span><?php echo"$name"?></span>, this is the Studies section</h1>
            <a href="logout.php" class="btn"> Logout</a>
        </div>
    </div>
</body>

</html>

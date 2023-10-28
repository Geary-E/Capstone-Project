<?php
//PHP coded by Jeremy Tollison

//Start the session
session_start();

//Include config file for database connection and functions
@include 'config.php';



//If the form is submitted
if (isset($_POST['submit'])) {

    $result = validate($conn);

    //If the user exists
    if (mysqli_num_rows($result) > 0) {

        //Saves the row where user info is stored
        $row = mysqli_fetch_array($result);

        //If the user_type is researcher 
        if ($row['user_type'] == 'researcher') {

            //Set the researcher_name to firstname 
           $_SESSION['researcher_name'] = $row['firstname'];

           //Send to dashboard.php
            header('location:dashboard.php');

        //If the user_type is person 
        } elseif ($row['user_type'] == 'person') {

           //Set the person_name to firstname
           $_SESSION['person_name'] = $row['firstname'];

           //Send to dashboard.php
            header('location:dashboard.php');
        }
    
    //If user does not exist
    } else {
        $error[] = 'Incorrect email or password';
    }
};
?>

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<head>
    
    <?php //Prints meta data
    meta(); ?>

    <link rel="stylesheet" href="style2.css">
    <title>Login</title>

</head>

<body>
    <div class="form-container2">

    <div class="login-bar">
                <h3>Log In</h3>
            </div>
        <form action="" method="post">

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <br>
            <br>
            <label for="email"><b>Email:</b></label><br>
            <input type="email" name="email" required placeholder="Enter your Email">
            <br>
            <br>

            <label for="password"><b>Password:</b></label><br>
            <input type="password" name="password" required placeholder="Enter a password">
            <br>
            
            <br>

            <div class="selection">
                <div class="forgot-password">
                    <a href="#">Forgot Password? </a>
                    </div>   
                <div class="button-list">
                    <button class="btn1" name="submit"> Log In </button>
                    <a href="login.php">
                    <button class="btn2"> Cancel </button>
                    </a>
                </div>

            </div>

                <br>    <!-- line breaks -->
                <br>    <!-- line breaks -->
                <br>    <!-- line breaks -->

            <p>Don't have an account? <a href="registration.php">Click here to register</a></p><br>

        </form>

    </div>
</body>

</html>
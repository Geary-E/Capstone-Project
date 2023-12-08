<?php
// PHP coded by Jeremy Tollison
// Start the session
session_start();

// Include config file for database connection and functions
@include 'config.php';

// If the form is submitted
if (isset($_POST['submit'])) {

    // Call the validate function to check the login
    $userValidation = validate($conn);

    // If the login is successful
    if ($userValidation === true) {

        // Fetch the user data
        $row = getUserData($conn, $_POST['email']); // Assuming you have a function to get user data

         //Set the userID as a session variable
         $_SESSION['userID'] = $row['userID'];

        if($row['user_type'] === 'researcher') {

            $_SESSION['researcher_name'] = $row['firstname'];    
            // Set session variables
            $_SESSION['firstName'] = $row['firstname'];
            $_SESSION['lastName'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_type'] = $row['user_type'];

            // Redirect to the dashboard
            header('location: dashboard.php');
            exit();
        } elseif ($row['user_type'] === 'person') {
            
            //Set the person_name session variable to firstname
            $_SESSION['person_name'] = $row['firstname'];

            /* Created session variales for the retrieval of information on account page */
            $_SESSION['firstName'] = $row['firstname'];
            $_SESSION['lastName'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];  
            $_SESSION['user_type'] = $row['user_type'];
            /* Ending of creation of session variables for account page */

            //Send to dashboard.php
            header('location:dashboard.php');
            }
        }
            else {
                // If user does not exist or password is incorrect
                $error[] = 'Incorrect email or password';
            }
}
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
                    <a href="index.php">
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
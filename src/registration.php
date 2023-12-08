<?php
//PHP coded by Jeremy Tollison
session_start();    // TEST
//Include config file for database connection and functions
@include 'config.php';

//If the form is submitted
if (isset($_POST['submit'])) {

    //Declares variables from the user table via $conn
    $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password']; 
    $confirmpass = $_POST['confirmpassword']; 
    $user_type = $_POST['user_type'];

    // Hash the password using bcrypt hashing algorithm - creates salt along with hashed password
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

    /* SELECT query statement */
    $select = " SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    //If the user exists stop
    if (mysqli_num_rows($result) > 0) { // if result is greater than 0
        $error[] = 'This user already exists';
    }

    //If the user does not exist
    else {

        //If the passwords do not match
        if ($pass != $confirmpass) {
            $error[] = 'Your passwords do not match';
        }

        //If the passwords match
        else {
            //Creates insert to add data into user table via conn
            $insert = "INSERT INTO user(firstname, lastname, email, password, user_type) VALUES('$first_name', '$last_name','$email','$hashedPassword','$user_type')";
            mysqli_query($conn, $insert);

            //Send to index.php (login page)
            header('location:index.php');
        }
    }
};
?>

<!DOCTYPE html> <!--HTML coded by Geary -->
<html lang="en">

<head>

    <?php //Prints meta data
    meta(); ?>

    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>

<body>
    <div class="form-container">

        <form action="" method="post">

            <!-- Updated Code: Author: Geary Erua -->
            <div class="top-bar">
                <h4>Registration</h4>
            </div>
            <br>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>

            <!-- Updated code - Author: Geary Erua -->

            <label for="fname"><b>First Name:</b></label><br>
            <input type="text" name="firstname" required placeholder="Enter your first name">
            <br>

            <label for="lname"><b>Last Name:</b></label><br>
            <input type="text" name="lastname" required placeholder="Enter your last name">
            <br>

            <label for="email"><b>Email:</b></label><br>
            <input type="email" name="email" required placeholder="Enter your Email">
            <br>

            <label for="password"><b>Password:</b></label><br>
            <input type="password" name="password" required placeholder="Enter a password">
            <input type="password" name="confirmpassword" required placeholder="Re-enter the password">
            <br>

            <!-- End of code updates -->

            <select name="user_type">
                <option value="person">Person</option>
                <option value="researcher">Researcher/Organization</option>
            </select>

            <input type="submit" name="submit" value="Click here to register" class="form-btn">
            <br>

            <p>Already have an account? <a href="index.php">Click here to login</a></p>
            
        </form>
    </div>
</body>
</html>
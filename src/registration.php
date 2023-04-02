<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $confirmpass = md5($_POST['confirmpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'This user already exists';
    } else {
        if ($pass != $confirmpass) {
            $error[] = 'Your passwords do not match';
        } else {
            $insert = "INSERT INTO user_form(name,email,password,user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

            <p>Already have an account? <a href="login.php">Click here to login</a></p>
        </form>

    </div>
</body>

</html>
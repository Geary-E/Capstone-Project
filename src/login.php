<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $confirmpass = md5($_POST['confirmpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'researcher') {

            $_SESSION['researcher_name'] = $row['name'];
            header('location:dashboard.php');
        } elseif ($row['user_type'] == 'person') {

            $_SESSION['person_name'] = $row['name'];
            header('location:dashboard.php');
        }
    } else {
        $error[] = 'Incorrect email or password';
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
    <title>Login</title>

</head>

<body>
    <div class="form-container">

        <form action="" method="post">

            <h3>Login now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="Enter your Email">
            <input type="password" name="password" required placeholder="Enter a password">
            <input type="submit" name="submit" value="Click here to login" class="form-btn">
            <p>Don't have an account? <a href="registration.php">Click here to register</a></p>
        </form>

    </div>
</body>

</html>
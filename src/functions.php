<?php
//PHP coded by Jeremy

//*****************************************************
//*Preliminary functions - Necessary for functionality*
//*****************************************************

/**
 * Used to set name variable based on user_type stored in $_SESSION
 * 
 * @return $name
 */
function nameType()
{
    //If researcher_name is set make it name
    if (isset($_SESSION['researcher_name'])) {
        $name = $_SESSION['researcher_name'];
    }

    //If person_name is set make it name
    elseif (isset($_SESSION['person_name'])) {
        $name = $_SESSION['person_name'];
    }
    return $name;
}

/**
 * Uses the input to return a result through $conn
 * 
 * @param mixed $conn
 * @return bool|mysqli_result
 */
function validate($conn)
{
    //Declares variables from the user table via $conn
    $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $confirmpass = md5($_POST['confirmpassword']);
    $user_type = $_POST['user_type'];

    //Variables for validation
    $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);
    return $result;
}

//**************************************************
//*Template functions - Templates for HTML elements*
//**************************************************

/**
 * Displays the meta data
 * 
 * @return void
 */
function meta()
{
    echo '
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    ';
}

//Module-Specific - Used in dashboard module

/**
 * Displays the header
 * @return void
 */
function pageHeader()
{
    echo '
    <div class="page-header" id="header">
        <div class="page-logo">
            <h2>Logo</h2>
        </div>
        <div class="buttons">
            <a href="dashboard.php">
                <button class="btn1">Dashboard</button>
            </a>
            <a href="logout.php">
                <button class="btn2">Logout</button>
            </a>
        </div>
    </div>
    ';
}

/**
 * Displays the navbar
 * @return void
 */
function pageNavbar($name)
{
    echo '
    <div class="navbar">
    <a href="#" onclick="showSearch()">Search Surveys</a>
    <a href="#" onclick="showManage()">Manage Surveys</a>
    </div>

    <!-- Content -->
    <div class="navbar-content">
    <div class="search-surveys">

        ';
    displaySearch($name);
    echo '
    </div>
    <div class="manage-surveys">

        ';
    displayManage($name);
    echo '
    </div>
    </div>
    ';
}

/**
 * Displays the search  content
 * @param $name 
 * @return void
 */
function displaySearch($name)
{
    echo '<h1>Hello <span>' . $name . '</span> this is the search survey section</h1>';
    // Generate additional HTML content for the Search Surveys page here
}

/**
 * Displays the manage content
 * @param $name 
 * @return void
 */
function displayManage($name)
{
    echo '<h1>Hello <span>' . $name . '</span> this is the manage survey section</h1>';
    // Generate additional HTML content for the Manage Surveys page here
}

// JavaScript functions

echo '
<script>
    function showSearch()
    {
        document.querySelector(\'.search-surveys\').style.display = \'block\';
        document.querySelector(\'.manage-surveys\').style.display = \'none\';
    }

    function showManage()
    {
        document.querySelector(\'.search-surveys\').style.display = \'none\';
        document.querySelector(\'.manage-surveys\').style.display = \'block\';
    }
</script>
';

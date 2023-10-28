<?php
//PHP coded by Jeremy
echo '<script src="functions.js"></script>';
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

/**
 * Displays the header
 * @return void
 */
function pageHeader()
{
    echo '
    <div class="page-header" id="header">
        <div class="header-content">
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
    </div>
    ';
}

/**
 * Displays the navbar
 * @param $name
 * @param $pageName
 * @return void
 */
function pageNavbar($name, $pageName)
{
    if($pageName=='Surveys')
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar">
                <a href="#" onclick="surveySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="surveyCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="surveyModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="surveyDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">';


                surveySearch($name);
                surveyCreate($name);
                surveyModify($name);
                surveyDelete($name);

                echo '
            </div>
        </div>
        ';
    }
    elseif($pageName=='Opportunities')
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar">
                <a href="#" onclick="opportunitySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="opportunityCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="opportunityModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="opportunityDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">';


                opportunitySearch($name);
                opportunityCreate($name);
                opportunityModify($name);
                opportunityDelete($name);

                echo '
            </div>
        </div>
        ';
    }
    elseif($pageName== 'Support Groups')
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar">
                <a href="#" onclick="supportGroupSearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="supportGroupCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="supportGroupModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="supportGroupDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">';


                supportGroupSearch($name);
                supportGroupCreate($name);
                supportGroupModify($name);
                supportGroupDelete($name);

                echo '
            </div>
        </div>
        ';
    }
}

//***************************
//*Module-Specific Functions*
//***************************



/**
 * Summary of surveySearch
 * @param mixed $name
 * @return void
 */
function surveySearch($name)
{
    
    echo '
    <div class="search-surveys">
    <h1>Hello <span>' . $name . '</span> this is the search survey section</h1>
    </div>
    ';
}

/**
 * Summary of surveyCreate
 * @param mixed $name
 * @return void
 */
function surveyCreate($name)
{
    echo '
    <div class="create-surveys">
    <h1>Hello <span>' . $name . '</span> this is the create survey section</h1>
    </div>
    ';
}

/**
 * Summary of surveyModify
 * @param mixed $name
 * @return void
 */
function surveyModify($name)
{
    echo '
    <div class="modify-surveys">
    <h1>Hello <span>' . $name . '</span> this is the modify survey section</h1>
    </div>
    ';
}

/**
 * Summary of surveyDelete
 * @param mixed $name
 * @return void
 */
function surveyDelete($name)
{
    echo '
    <div class="delete-surveys">
    <h1>Hello <span>' . $name . '</span> this is the delete survey section</h1>
    </div>
    ';
}

/**
 * Summary of opportunitySearch
 * @param mixed $name
 * @return void
 */
function opportunitySearch($name)
{
    
    echo '
    <div class="search-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the search opportunity section</h1>
    </div>
    ';
}

/**
 * Summary of opportunityCreate
 * @param mixed $name
 * @return void
 */
function opportunityCreate($name)
{
    echo '
    <div class="create-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the create opportunity section</h1>
    </div>
    ';
}

/**
 * Summary of opportunityModify
 * @param mixed $name
 * @return void
 */
function opportunityModify($name)
{
    echo '
    <div class="modify-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the modify opportunity section</h1>
    </div>
    ';
}

/**
 * Summary of opportunityDelete
 * @param mixed $name
 * @return void
 */
function opportunityDelete($name)
{
    echo '
    <div class="delete-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the delete opportunity section</h1>
    </div>
    ';
}

/**
 * Summary of supportGroupSearch
 * @param mixed $name
 * @return void
 */
function supportGroupSearch($name)
{
    
    echo '
    <div class="search-supportGroups">
    <h1>Hello <span>' . $name . '</span> this is the search support group section</h1>
    </div>
    ';
}

/**
 * Summary of supportGroupCreate
 * @param mixed $name
 * @return void
 */
function supportGroupCreate($name)
{
    echo '
    <div class="create-supportGroups">
    <h1>Hello <span>' . $name . '</span> this is the create support group section</h1>
    </div>
    ';
}

/**
 * Summary of supportGroupModify
 * @param mixed $name
 * @return void
 */
function supportGroupModify($name)
{
    echo '
    <div class="modify-supportGroups">
    <h1>Hello <span>' . $name . '</span> this is the modify support group section</h1>
    </div>
    ';
}

/**
 * Summary of supportGroupDelete
 * @param mixed $name
 * @return void
 */
function supportGroupDelete($name)
{
    echo '
    <div class="delete-supportGroups">
    <h1>Hello <span>' . $name . '</span> this is the delete support group section</h1>
    </div>
    ';
}

?>
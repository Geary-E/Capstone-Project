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
 * @param $conn
 * @param $name
 * @param $pageName
 * @return void
 */
function pageNavbar($conn, $name, $pageName)
{
    if($pageName=='Surveys') //Navbar for surveys start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="surveySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="surveyCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="surveyModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="surveyDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->

                <div class="search-surveys">'; //Container for searchSurvey module
                    surveySearch($name, $conn);  //Displays the surveySearch content
                    echo '
                        </div>
                    ';
                surveyCreate($name); //Displays the surveyCreate content
                surveyModify($name); //Displays the surveyModify content
                surveyDelete($name); //Displays the surveyDelete content

                echo '
            </div>
        </div>
        ';
    } //Navbar for surveys end
    elseif($pageName=='Opportunities') //Navbar for Opportunities start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="opportunitySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="opportunityCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="opportunityModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="opportunityDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">';


                opportunitySearch($name); //Displays the opportunitySearch content
                opportunityCreate($name); //Displays the opportunityCreate content
                opportunityModify($name); //Displays the opportunityModify content
                opportunityDelete($name); //Displays the opportunityDelete content

                echo '
            </div>
        </div>
        ';
    } //Navbar for Opportunities end
    elseif($pageName== 'Support Groups') //Navbar for Support Groups start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="supportGroupSearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="supportGroupCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="supportGroupModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="supportGroupDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">';


                supportGroupSearch($name); //Displays the supportGroupSearch content 
                supportGroupCreate($name); //Displays the supportGroupCreate content
                supportGroupModify($name); //Displays the supportGroupModify content
                supportGroupDelete($name); //Displays the supportGroupDelete content

                echo '
            </div>
        </div>
        ';
    } //Navbar for Support Groups end
    elseif($pageName== 'Studies') //Navbar for Studies start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="studySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="studyCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="studyModify()">Modify ' . $pageName . '</a>
                <a href="#" onclick="studyDelete()">Delete ' . $pageName . '</a>
            </div>

            <div class="page-content">';

                studySearch($name); //Displays the studySearch content
                studyCreate($name); //Displays the studyCreate content
                studyModify($name); //Displays the studyModify content
                studyDelete($name); //Displays the studyDelete content

                echo '
            </div>
        </div>
        ';
    }
} //Navbar for Studies end





//***************************
//*Module-Specific Functions*
//***************************

/**
 * Summary of surveySearch
 * @param mixed $name
 * @param mixed $conn
 * @return void
 */
function surveySearch($name, $conn)
{
    echo '
    <div class="search-surveys-box">
        <h1>Hello <span>' . $name . '</span> this is the search survey section</h1>
        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes"><!-- Search boxes section -->
            <p style="display: block;">Search By:</p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="survey-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Survey name"></div>
            <div class="survey-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="submit" value="submit" type="submit">Search</button>
            </div>

        </form>

        <div class="survey-list">';

        $select = "SELECT * FROM survey";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) == 0) { //if result == 0
            $error[] = 'No surveys were found';
        }
        else if (mysqli_num_rows($result) > 0) { //if there are surveys 
            while ( $row = mysqli_fetch_assoc($result) ) {
                /* Added styling to the queried search results */
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';    /* <br> */
            }
        }

    echo'
        </div> <!-- survey-list end -->
        <div class="search-survey-list" style="display: none;">';
    if (isset($_POST['submit'])) {
        echo '<script>hideAll();</script>'; 

        //Access searchName and searchTag variables
        $searchName = $_POST['searchName'];
        $searchTag = $_POST['searchTag'];

        $select = "SELECT * FROM survey WHERE name LIKE '%$searchName%'"; 
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) == 0) { //if result == 0
            $error[] = 'No surveys were found';
        }
        else if (mysqli_num_rows($result) > 0) {  //if there are surveys 
            while ( $row = mysqli_fetch_assoc($result) ) {
                /* Added styling to the queried search results */
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';       
            }
        }
        unset($_POST['submit']);
    }
    echo'
        </div> <!-- search-surveys-list end -->
    </div> <!-- search-surveys-box end -->
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
 * Summary of studySearch
 * @param mixed $name
 * @return void
 */
function studySearch($name)
{
    
    echo '
    <div class="search-studies">
    <h1>Hello <span>' . $name . '</span> this is the search study section</h1>
    </div>
    ';
}

/**
 * Summary of studyCreate
 * @param mixed $name
 * @return void
 */
function studyCreate($name)
{
    echo '
    <div class="create-studies">
    <h1>Hello <span>' . $name . '</span> this is the create study section</h1>
    </div>
    ';
}

/**
 * Summary of studyModify
 * @param mixed $name
 * @return void
 */
function studyModify($name)
{
    echo '
    <div class="modify-studies">
    <h1>Hello <span>' . $name . '</span> this is the modify study section</h1>
    </div>
    ';
}

/**
 * Summary of studyDelete
 * @param mixed $name
 * @return void
 */
function studyDelete($name)
{
    echo '
    <div class="delete-studies">
    <h1>Hello <span>' . $name . '</span> this is the delete study section</h1>
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

echo '<script src="functions.js"></script>';
?>
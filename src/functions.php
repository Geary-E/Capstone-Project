<?php
//PHP coded by Jeremy

//*****************************************************
//*Preliminary functions - Necessary for functionality*
//*****************************************************

function userID() {
    if(isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        }
        return $userID;
}
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

/* Functions implemented for use of retrieval of information on the accounts page */
function emailType() 
{
    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        }
        return $email;
} 

function userType() {
    if(isset($_SESSION['user_type'])) {
        $user_type = $_SESSION['user_type'];
    }
    return $user_type;
}

function firstNameType() {
    if(isset($_SESSION['firstName'])) {
        $firstname = $_SESSION['firstName'];
    }
    return $firstname;
}

function lastNameType() {
    if(isset($_SESSION['lastName'])) {
        $lastname = $_SESSION['lastName'];
    }
    return $lastname;
}


function chooseFile() {
    echo '
    <form class="upload-form" action="upload.php"  method="POST" enctype="multipart/form-data">
           <input class="img-form" style="display:none;" type="file" name="file">
            <button class="submit-form" style="display:none;" type="submit" name="submit"> UPLOAD </button>
</form>
    ';
}
/* End of retrieval functions for account page */

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
 * @param mixed $conn
 * @param mixed $pageName
 * @param mixed $name
 * @param mixed $userID
 * @return void
 */
function pageNavbar($conn, $pageName, $name, $userID)
{
    if($pageName=='Surveys') //Navbar for surveys start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="survey.php">Search ' . $pageName . '</a>
                <a href="surveyModify.php">Modify ' . $pageName . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->

                <div class="search-surveys">'; //Container for searchSurvey module
                    surveySearch($name, $conn);  //Displays the surveySearch content
                    echo '
                </div>
            </div>
        </div>
        ';
    } //Navbar for surveys end
    elseif($pageName=='SurveysModify') //Navbar for surveysModify start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Modify ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';

                surveyModify($name, $userID, $conn); //Displays the surveyModify content
                surveyCreate($name, $userID, $conn); //Displays the surveyCreate content

                echo '
            </div>
        </div>';

    }//Navbar for surveysModify end
    elseif($pageName=='SurveysEdit') //Navbar for surveysModify start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Modify ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';

                surveyEdit($name, $userID, $conn); //Displays the surveyEdit content

                echo '
            </div>
        </div>';

    }//Navbar for surveysModify end
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

            <div class="page-content">
				<div class="search-studies">'; //Container for searchStudy module
                studySearch($name, $conn);  //Displays the studySearch content
                echo '
                    </div>';

                studyCreate($name, $conn);  //Displays the studyCreate content

					
                studyModify($name); //Displays the studyModify content
                studyDelete($name); //Displays the studyDelete content

                echo '
            </div>
        </div>
        ';
    } //Navbar for Studies end
    else if($pageName = 'Account Page') {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="generalAccountDisplay()">General ' . '</a> <!-- General page -->
                <a href="#/faq" onclick="faq()">FAQ ' . '</a>    <!-- FAQ Page -->
                <a href="#/compensation" onclick="accountCompensation()">Compensation ' . '</a>  <!-- Compensation page -->
            </div> 
            <div class="page-content">';
                $last_name = lastNameType();
                $email = emailType();
                $user_type = userType();
                echo '<div class="account-page-display">';
                accountPageDisplay($email, $user_type, $name, $last_name);
                echo '</div>'; 
                accountPageFaq();   /* the FAQ page */
                accountPageComp($name);   /* the compensation page */
            echo '
            </div>
            </div>';

    }//Navbar for Account Page end
} //Navbar end





//***************************
//*Module-Specific Functions*
//***************************

 /**
  * Summary of accountPageDisplay
  * @param mixed $email
  * @param mixed $user_type
  * @param mixed $first_name
  * @param mixed $last_name
  * @return void
  */
/* Display for the account page */
  function accountPageDisplay($email, $user_type, $first_name, $last_name) { //Created by Geary
    echo '
        <div class="account-page-box">';
        echo '
        <h1>Welcome to the Account Page.</h1>
        
        <!--Profile Information for account page -->

        <div class="profile-header">
        <img class="profile-pic" src="./images/profile_pic.png" alt="Profile pic"><br>
        </div><br>
        <div class="header-links">
       <form class="upload-form" action="upload.php"  method="POST" enctype="multipart/form-data">
        <label for="img-form">Upload</label><input id="img-form" type="file" name="file"/>
         <!--<button class="submit-form" type="submit" name="submit"> UPLOAD </button> -->
        </form>
            <a href="#"> Edit </a>
            </div>
        <div class="profile-information">
        <label for="myInput">First Name: </label><input type="text" id="myInput" value="'. $first_name .'" readonly><br>
        <label for="myInput1">Last Name: </label><input type="text" id="myInput1" value="'. $last_name .'" readonly><br>
         <label for="myInput2">Email:</label><input type="text" id="myInput2" value="'. $email .'" readonly><br>
        <label for="myInput3">User-Type:</label><input type="text" id="myInput3" value="'. $user_type .'" readonly><br>
            <div class="button-list">
                <button class="save-btn"> Save </button>
                <button class="cancel-btn"> Cancel </button>
            </div>
            </div>

            <!-- Profile Information on account page ends -->
        </div>';
 }
 /* Account page display end */

/* Display for the FAQ link on the account page */
 function accountPageFaq() {
    echo '
    <div class="faq-section">

        <h1 style="font-size: 25px;"> Frequently Asked Questions (FAQ): </h1>

        <div class="faq-list">
        <div class="faq-item">
        <p><b>Q:</b> Question 1? </p>
        <p><b>A:</b> Answer 1. </p>
        </div><br>

        <div class="faq-item">
        <p><b>Q:</b> Question 2?  </p>
        <p><b>A:</b> Answer 2. </p>
        </div><br>

        <div class="faq-item">
        <p><b>Q:</b> Question 3?  </p>
        <p><b>A:</b> Answer 3. </p>
        </div><br>

        <div class="faq-item">
        <p><b>Q:</b> Question 4?  </p>
        <p><b>A:</b> Answer 4. </p>
        </div><br>

        </div>
        </div>
    ';
 }
 /* FAQ link display end */

/* Display for the compensation link on the account page */
 function accountPageComp($name) {
    echo '
    <div class="compensation-section">
        <h1 style="font-size: 25px;"> User Compensation: </h1>

        <div class="compensation-listing">
            <div class="compensation-item">
            <h1 class="compensation-header" style="font-size: 35px;">'.$name.' has made: </br>
            $0.00 </h1>
            </div>
        </div>

    </div>';
 }
/* Compensation link display end */

 /**
 * Summary of surveySearch
 * @param mixed $name
 * @param mixed $conn
 * @return void
 */
function surveySearch($name, $conn)
{
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    };
    echo '
    <div class="search-surveys-box">
        <h1>Hello <span>' . $name . '</span> this is the search survey section</h1>
        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes"><!-- Search boxes section -->
            <p style="display: block;">Search By:</p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="survey-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Survey name"></div>
            <div class="survey-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="surveySearch" value="submit" type="submit">Search</button>
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
    if (isset($_POST['surveySearch'])) {
        echo '<script>hideAll();</script>';

        //Access searchName and searchTag variables
        $searchName = mysqli_real_escape_string($conn, $_POST['searchName']);
        $searchTag = mysqli_real_escape_string($conn, $_POST['searchTag']);

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
        unset($_POST['surveySearch']);
    }
    echo'
        </div> <!-- search-surveys-list end -->
    </div> <!-- search-surveys-box end -->
    ';
}

/**
 * Summary of surveyCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyCreate($name, $userID, $conn)
{

    echo '
    <div class="create-surveys">
    <h1>Hello <span>' . $name . '</span> this is the create survey section</h1>

    <form action="" method="post">
		<label for="surveyname"><b>Survey Name:</b></label><br>
		<input type="text" id="survey_name" name="survey_name" required placeholder="Survey name">
		<br><br>
	
		<label for="surveydescription"><b>Study Description:</b></label><br>
		<input type="text" id="survey_description" name="survey_description" required placeholder="Study description">
		<br><br>
		
		<label for="surveytags"><b>Survey tag(s):</b></label><br>
		<input type="text" id="survey_tags" name="survey_tags" required placeholder="Survey tag(s)">
		<br><br>
	
		<input type="submit" name="createSurvey" value="Create new survey" class="form-btn">
		<input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="cancel" class="cancel-link"></input>
        <br><br>
	</form>
    </div> <!-- create-surveys end -->';

    if (isset($_POST['createSurvey'])) {
        $name = mysqli_real_escape_string($conn, $_POST['survey_name']);
        $description = mysqli_real_escape_string($conn, $_POST['survey_description']);
        $insert = "INSERT INTO `survey` (`surveyID`, `ownerID`, `name`, `description`) VALUES (NULL, '$userID', '$name', '$description');";
        if (mysqli_query($conn, $insert)) {
            echo "Survey inserted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createSurvey']);
    }
}

/**
 * Summary of surveyModify
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyModify($name, $userID, $conn)
{
    echo '
    <div class="modify-surveys">
    <h1>Hello <span>' . $name . '</span> this is the modify survey section</h1>

    <h1><a href="#" onclick="surveyCreate()">Click here to create a new survey</a></h1>

    <h1>These are the surveys you have created:</h1>
    <div class="created-surveys-list">';
    $select = "SELECT * FROM survey WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editSurveyID']);
    if (mysqli_num_rows($result) == 0) { // If no surveys were found
        echo '<h1>No surveys were found</h1>';
    } else if (mysqli_num_rows($result) > 0) { // If there are surveys
        while ($row = mysqli_fetch_assoc($result)) {
            /* Added styling to the queried search results */
            echo '
            <div class="survey-item">
                <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '
            </div> <!-- survey-item end -->
            <br>';

            echo '
            <form method="post" action="surveyEdit.php">
                <input type="hidden" name="editSurveyID" value="' . $row['surveyID'] . '">
                <button type="submit" name="editSurvey" class="edit-button">Edit</button>
            </form>';

            echo'
            <form method="post" action="" onsubmit="return confirm(\'Are you sure you want to delete this survey?\');">
                  <input type="hidden" name="survey_id" value="' . $row['surveyID'] . '">
                  <button name="deleteSurvey" value="submit" type="submit">Delete</button>
            </form>
            <br>';
        }
    }
    echo '
    </div> <!-- created-surveys-list end -->

    <h1>These are the surveys you have completed:</h1>
        <div class="created-surveys-list">';

    echo '
    </div> <!-- created-surveys-list end -->
    </div> <!-- modify-surveys end -->
    ';

    if (isset($_POST['deleteSurvey'])) {
        // Handle the delete logic here
        $surveyID = mysqli_real_escape_string($conn, $_POST['survey_id']);
        $deleteQuery = "DELETE FROM survey WHERE surveyID = '$surveyID';";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Survey deleted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

function surveyEdit($name, $userID, $conn)
{ 
    $surveyName = ''; // Initialize variable with default value
    $surveyDescription = ''; // Initialize variable with default value
    $edittedSurveyID = ''; // Initialize variable with default value
    if (isset($_POST['editSurveyID'])) {
        // Access the surveyID
        $edittedSurveyID = $_POST['editSurveyID'];

        // Fetch survey data from the database using the $edittedSurveyID
        $selectSurveyData = "SELECT `name`, `description` FROM `survey` WHERE `surveyID` ='$edittedSurveyID';";
        $resultSurveyData = mysqli_query($conn, $selectSurveyData);

        if ($resultSurveyData && mysqli_num_rows($resultSurveyData) > 0) {
            $row = mysqli_fetch_assoc($resultSurveyData);
            $surveyName = $row['name'];
            $surveyDescription = $row['description'];
        }
    }
    
    echo '
    <div class="edit-surveys">
    <h1>Hello <span>' . $name. ' '.$edittedSurveyID.'</span> this is the edit survey section</h1>';

/*
What was done:
-Store the data for the name and description from the survey table via the $surveyID in the variables $surveyName $surveyDescription
-Two forms, one for each part of the survey table: ( `name`, `description`)
-Use the $surveyName data as a placeholder for the name form, and the $surveyDescription data as a placeholder for the description form
-Submit form that posts updateSurvey
-Verify that when submitted the data in the forms will update the survey table row name and description column where the $surveyID is equal
*/
    echo '
    <form action="" method="post">
    <input type="hidden" name="editSurveyID" value="' . $edittedSurveyID . '">
    <label for="surveyName">Survey Name:</label>
    <input type="text" name="surveyName" value="' . $surveyName . '" class="form-input" required>
    <br>
    <label for="surveyDescription">Survey Description:</label>
    <textarea name="surveyDescription" class="form-textarea" required>' . $surveyDescription . '</textarea>
    <br>
    <input type="submit" name="updateSurvey" value="Submit" class="form-btn"> 
    <input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="Cancel" class="cancel-link">
    <br>
</form>
    </div> <!-- edit-surveys end -->
    ';

    if (isset($_POST['updateSurvey'])) {
        // Handle the edit logic here
        $surveyName = mysqli_real_escape_string($conn, $_POST['surveyName']);
        $surveyDescription = mysqli_real_escape_string($conn, $_POST['surveyDescription']);
        echo $edittedSurveyID;
        $editQuery = "UPDATE `survey` SET `name` = '$surveyName', `description` = '$surveyDescription' WHERE `survey`.`surveyID` = '$edittedSurveyID';";
        
        if (mysqli_query($conn, $editQuery)) {
            echo "update successful ";
            //header('location: surveyModify.php');
            //exit(); // Important to prevent further execution after the redirect
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

/**
 * Summary of opportunitySearch
 * @param mixed $name
 * @return void
 */
function opportunitySearch($name)
{
    
    echo '
    <div class="search-opportunities-box">
    <h1>Hello <span>' . $name . '</span> this is the search opportunity section</h1>
    
    <!-- Implemented search boxes -->
    <form action="" method="post"> <!-- Buttons for the search -->
    <div class="search-boxes"><!-- Search boxes section -->
    <p style="display: block;">Search By:</p> <br><br>
    <!-- Added labels to the search boxes -->
    <div class="opportunity-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Study name"></div>
    <div class="opportunity-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
    <button name="submit" value="submit" type="submit">Search</button>
    </div>

</form>
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
function studySearch($name,$conn)
{
    
    echo '
    <div class="search-studies-box">
    <h1>Hello <span>' . $name . '</span> this is the search study section</h1>

    <!-- Implemented search boxes -->
    <form action="" method="post"> <!-- Buttons for the search -->
    <div class="search-boxes"><!-- Search boxes section -->
    <p style="display: block;">Search By:</p> <br><br>
    <!-- Added labels to the search boxes -->
    <div class="study-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Study name"></div>
    <div class="study-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
    <button name="submit" value="submit" type="submit">Search</button>
    </div>
	</form>
	
    <div class="survey-list">';

        $select = "SELECT * FROM study";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) == 0) { //if result == 0
            $error[] = 'No studies were found';
        }
        else if (mysqli_num_rows($result) > 0) { //if there are studies 
            while ( $row = mysqli_fetch_assoc($result) ) {
                /* Added styling to the queried search results */
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '<br><b>Date:</b> ' . $row['date'] . '<br><b>Location:</b> ' . $row['location'] . '<br><b>Compensation:</b> ' . $row['compensation'];
                echo '</div><br>';    /* <br> */
            }
        }

    echo'
        </div> <!-- study-list end -->
        <div class="search-survey-list" style="display: none;">';
    if (isset($_POST['submit'])) {
        echo '<script>hideAll();</script>'; 

        //Access searchName and searchTag variables
        $searchName = $_POST['searchName'];
        $searchTag = $_POST['searchTag'];

        $select = "SELECT * FROM study WHERE name LIKE '%$searchName%'"; 
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) == 0) { //if result == 0
            $error[] = 'No studies were found';
        }
        else if (mysqli_num_rows($result) > 0) {  //if there are studies 
            while ( $row = mysqli_fetch_assoc($result) ) {
                /* Added styling to the queried search results */
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '<br><b>Date:</b> ' . $row['date'] . '<br><b>Location:</b> ' . $row['location'] . '<br><b>Compensation:</b> ' . $row['compensation'];
                echo '</div><br>';       
            }
        }
        unset($_POST['submit']);
    }
    echo'
        </div> <!-- search-studys-list end -->
    </div> <!-- search-studys-box end -->
    ';
}

/**
 * Summary of studyCreate
 * @param mixed $name
 * @return void
 */
function studyCreate($name,$conn)
{
    echo '<div class="create-studies">
    <h1>Hello <span>' . $name . '</span> this is the create study section</h1>
    <form action="" method="post">';
		if (isset($error)) {
			foreach ($error as $error) {
				echo '<span class="error-msg">' . $error . '</span>';
			};
		};
		
	echo'
		<label for="studyname"><b>Study Name:</b></label><br>
		<input type="text" name="study_name" required placeholder="Enter the study name">
		<br><br>
	
		<label for="studydescription"><b>Study Description:</b></label><br>
		<input type="text" name="study_desc" required placeholder="Enter the study description">
		<br><br>
		
		<label for="studylocation"><b>Study location:</b></label><br>
		<input type="text" name="study_loc" required placeholder="Enter the study location">
		<br><br>
		
		<label for="studytime"><b>Study date(YYYY-MM-DD hh:mm):</b></label><br>
		<input type="text" name="study_time" required placeholder="Enter the study time">
		<br><br>
		
		<label for="studycompensation"><b>Study Compensation (in US dollors):</b></label><br>
		<input type="text" name="study_com" required placeholder="Enter the study compensation">
		<br><br>
		
		<label for="studytags"><b>Study tag(s):</b></label><br>
		<input type="text" name="study_tags" value="tag1" required placeholder="Enter the study tag(s)">
		<br><br>
	
		<input type="submit" name="createStudy" value="Create new study" class="form-btn">
		<input type="button" onClick="" name="cancel" value="cancel" class="cancel-link"></input><br>
		<br>
	</form></div>';
	
	//Assigns input from input fields to varibles
	if (isset($_POST['createStudy'])) {
		$user_id = $_SESSION['userID'];
		$stu_name = mysqli_real_escape_string($conn, $_POST['study_name']);
		$stu_desc = mysqli_real_escape_string($conn, $_POST['study_desc']);
		$stu_loc = mysqli_real_escape_string($conn, $_POST['study_loc']);
		$stu_time = mysqli_real_escape_string($conn, $_POST['study_time']);
		$stu_com = mysqli_real_escape_string($conn, $_POST['study_com']);
		$stu_tags = mysqli_real_escape_string($conn, $_POST['study_tags']);
    
		//$insert2 = "INSERT INTO study(,,study_name, study_desc, study_loc, study_time, study_com, study_tags) VALUES('','','$stu_name','$stu_desc','$stu_loc','$stu_time','$stu_com','$stu_tags')";
		
		//Creates new row into the study table
		$insert2 = "INSERT INTO `study`(`ownerID`, `name`, `description`, `location`, `date`, `compensation`) VALUES ('$user_id','$stu_name','$stu_desc','$stu_loc','$stu_time','$stu_com')";
		mysqli_query($conn, $insert2);
		
		//Gets the newly created row's id
		$result = mysqli_insert_id($conn);
		
		//Creates new row into the user_study table
		$insert3 = "INSERT INTO `user_study`(`userID`, `studyID`) VALUES ('$user_id','$result')";
		mysqli_query($conn, $insert3);				
	}
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
    <div class="search-supportGroups-box">
    <h1>Hello <span>' . $name . '</span> this is the search support group section</h1>
   
    <!-- Implemented search boxes -->
    <form action="" method="post"> <!-- Buttons for the search -->
    <div class="search-boxes"><!-- Search boxes section -->
    <p style="display: block;">Search By:</p> <br><br>
    <!-- Added labels to the search boxes -->
    <div class="support-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Study name"></div>
    <div class="support-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
    <button name="submit" value="submit" type="submit">Search</button>
    </div>

</form>
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
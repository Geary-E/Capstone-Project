<?php
//PHP coded by Jeremy

//*****************************************************
//*Preliminary functions - Necessary for functionality*
//*****************************************************

/**
 * Used to set userID as a variable which is stored in $_SESSION
 * 
 * @return $userID
 */
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

/* Created by Geary - Functions implemented for use of retrieval of information on the accounts page */
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
/* Created by Geary -  End of retrieval functions for account page */

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
                <a href="surveyModify.php">Manage ' . $pageName . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->
                <div class="search-surveys">'; //Container for searchSurvey module
                    surveySearch($name, $conn);  //Displays the surveySearch content
                    echo '
                </div>
            </div>
        </div>';
    } //Navbar for surveys end
    elseif($pageName=='SurveysModify') //Navbar for surveysModify start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                surveyModify($name, $userID, $conn); //Displays the surveyModify content
                surveyCreate($name, $userID, $conn); //Displays the surveyCreate content
                echo '
            </div>
        </div>';
    }//Navbar for surveysModify end
    elseif($pageName=='SurveysEdit') //Navbar for surveysEdit start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';
                surveyEdit($name, $userID, $conn); //Displays the surveyEdit content
                echo '
            </div>
        </div>';
    }//Navbar for surveysEdit end
    elseif($pageName=='Opportunities') //Navbar opportunities start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="opportunity.php">Search ' . $pageName . '</a>
                <a href="opportunityModify.php">Manage ' . $pageName . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->
                <div class="search-opportunities">'; //Container for searchOpportunity module
                    opportunitySearch($name, $conn);  //Displays the opportunitySearch content
                    echo '
                </div>
            </div>
        </div>';
    } //Navbar for opportunities end
    elseif($pageName=='OpportunitiesModify') //Navbar for opportunitiesModify start
    {
        $pageNameDisplay='Opportunities';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="opportunity.php">Search ' . $pageNameDisplay . '</a>
            <a href="opportunityModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                opportunityModify($name, $userID, $conn); //Displays the opportunityModify content
                opportunityCreate($name, $userID, $conn); //Displays the opportunityCreate content
                echo '
            </div>
        </div>';
    }//Navbar for opportunitiesModify end
    elseif($pageName=='OpportunitiesEdit') //Navbar for opportunitiesEdit start
    {
        $pageNameDisplay='Opportunities';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="opportunity.php">Search ' . $pageNameDisplay . '</a>
            <a href="opportunityModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                opportunityEdit($name, $userID, $conn); //Displays the opportunitityEdit content
                echo '
            </div>
        </div>';
    }//Navbar for opportunitiesEdit end
    elseif($pageName=='Support Groups') //Navbar Support Groups start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="supportGroup.php">Search ' . $pageName . '</a>
                <a href="supportGroupModify.php">Manage ' . $pageName . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->
                <div class="search-supportGroups">'; //Container for searchOpportunity module
                    supportGroupSearch($name, $conn);  //Displays the opportunitySearch content
                    echo '
                </div>
            </div>
        </div>';
    } //Navbar for Support Groups end
    elseif($pageName=='SupportGroupsModify') //Navbar for supportGroupModify start
    {
        $pageNameDisplay='Support Groups';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="supportGroup.php">Search ' . $pageNameDisplay . '</a>
            <a href="supportGroupModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                supportGroupModify($name, $userID, $conn); //Displays the supportGroupModify content
                supportGroupCreate($name, $userID, $conn); //Displays the supportGroupCreate content
                echo '
            </div>
        </div>';
    }//Navbar for supportGroupsModify end
    elseif($pageName=='SupportGroupsEdit') //Navbar for supportGroupEdit start
    {
        $pageNameDisplay='Support Groups';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="supportGroup.php">Search ' . $pageNameDisplay . '</a>
            <a href="supportGroupModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                supportGroupEdit($name, $userID, $conn); //Displays the supportGroupEdit content
                echo '
            </div>
        </div>';
    }//Navbar for supportGroupEdit end
    elseif($pageName=='Studies') //Navbar for Studies start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="studySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="studyCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="studyModify()">Modify ' . $pageName . '</a>
            </div>

            <div class="page-content">
				<div class="search-studies">'; //Container for searchStudy module
                studySearch($name, $conn);  //Displays the studySearch content
                echo '
                    </div>';
                studyCreate($name, $conn);  //Displays the studyCreate content
				echo '

				<div class="modify-studies">';
                studyModify($name,$userID,$conn); //Displays the studyModify content
				echo '
					</div>
				<div class="delete-studies">';
				
				studyDelete($name,$userID,$conn);
                echo '
				</div>
            </div>
        </div>
        ';
    } //Navbar for Studies end

    elseif($pageName=='StudiesEdit') //Navbar for studiesEdit start

    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="#" onclick="studySearch()">Search ' . $pageName . '</a>
                <a href="#" onclick="studyCreate()">Create ' . $pageName . '</a>
                <a href="#" onclick="studyModify()">Modify ' . $pageName . '</a>
            </div>

            <div class="page-content">';
				
				studyDelete($name,$userID,$conn);
                echo '

            </div>
        </div>
        ';

    } //Navbar for studiesEdit end
    else if($pageName = 'Account Page') { //Navbar for Account Page start

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
    //Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    };
    echo '
    <div class="search-surveys-box">
        <h1>Hello <span>' . $name . '</span> this is the search survey section</h1>
        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes">
            <p style="display: block;">Search By:</p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="survey-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Survey name"></div>
            <div class="survey-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="surveySearch" value="submit" type="submit">Search</button>
            </div> <!-- search-boxes end -->
        </form>

        <div class="survey-list">';

        //Select from all surveys
        $select = "SELECT * FROM survey";
        $result = mysqli_query($conn, $select);

        //If there are no surveys
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No surveys were found';
        }

        //If there are surveys
        else if (mysqli_num_rows($result) > 0) {

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {

                //Lists all surveys
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';
            } //While end
        } //Else if end

    echo'
        </div> <!-- survey-list end -->
        <div class="search-survey-list" style="display: none;">';

    //If surveySearch is posted
    if (isset($_POST['surveySearch'])) {
        echo '<script>hideAll();</script>';

        //Access searchName and searchTag variables from the posted data
        $searchName = mysqli_real_escape_string($conn, $_POST['searchName']);
        $searchTag = mysqli_real_escape_string($conn, $_POST['searchTag']);

        //Select from survey table where name variable is similar
        $select = "SELECT * FROM survey WHERE name LIKE '%$searchName%'";
        $result = mysqli_query($conn, $select);

        //If there are no surveys
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No surveys were found';
        }

        //If there are surveys
        else if (mysqli_num_rows($result) > 0) { 

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {
                
                //Lists surveys where name and tag is included in the search fields
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';       
            } //While end
        } //Else if end
        unset($_POST['surveySearch']);
    } //If end
    echo'
        </div> <!-- search-surveys-list end -->
    </div> <!-- search-surveys-box end -->';
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

    <form action="" method="post"> <!-- form for create survey info start-->
		<label for="surveyname"><b>Survey name:</b></label><br> <!-- surveyName button -->
		<input type="text" id="survey_name" name="survey_name" required placeholder="Survey name">
		<br><br>
	
		<label for="surveydescription"><b>Survey description:</b></label><br> <!-- surveyDescription button -->
		<input type="text" id="survey_description" name="survey_description" required placeholder="Survey description">
		<br><br>
		
		<label for="surveytags"><b>Survey tag(s):</b></label><br> <!-- surveyTags button -->
		<input type="text" id="survey_tags" name="survey_tags" required placeholder="Survey tag(s)">
		<br><br>
	
		<input type="submit" name="createSurvey" value="Create new survey" class="form-btn"> <!-- createSurvey button -->
		<input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="cancel" class="cancel-link"></input> <!-- cancel button links to surveyModify.php-->
        <br><br>
	</form> <!-- form for create survey info end-->
    </div> <!-- create-surveys end -->';

    //If createSurvey is posted
    if (isset($_POST['createSurvey'])) {

        //Create name and description variables from the posted data
        $name = mysqli_real_escape_string($conn, $_POST['survey_name']);
        $description = mysqli_real_escape_string($conn, $_POST['survey_description']);

        //Insert into survey table with the created variables
        $insert = "INSERT INTO `survey` (`surveyID`, `ownerID`, `name`, `description`) VALUES (NULL, '$userID', '$name', '$description');";
        
        //If query was successful
        if (mysqli_query($conn, $insert)) {
            echo "Survey inserted successfully!";
        }

        //If query was not successful
        else { 
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createSurvey']);
    } //If end
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
    <h1>Hello <span>' . $name . '</span> this is the manage survey section</h1>

    <h1> Created Surveys: </h1>
    <div class="created-surveys-list">';

    //Select from survey table where userID is equal
    $select = "SELECT * FROM survey WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editSurveyID']);

    //If no surveys were found
    if (mysqli_num_rows($result) == 0) {
        echo '<h1>No surveys were found</h1>';
    }

    //If there are surveys
    else if (mysqli_num_rows($result) > 0) {

        //While row in table exists via result
        while ($row = mysqli_fetch_assoc($result)) { 

            //Lists surveys where where userID is equal
            echo '<div class="survey-item">
               <p> <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '</p>
               
                <div class="edit-delete-buttons"> <!-- edit and delete buttons div start  -->
            
                <form method="post" class="edit-method" action="surveyEdit.php">
                   <input type="hidden" name="editSurveyID" value="' . $row['surveyID'] . '">
                   <button type="submit" name="editSurvey">Edit</button>
                </form>';
   
                echo'
                <!-- deleteSurvey button -->
                <form method="post" action="" class="delete-method" onsubmit="return confirm(\'Are you sure you want to delete this survey?\');">
                    <input type="hidden" name="survey_id" value="' . $row['surveyID'] . '">
                    <button name="deleteSurvey" value="submit" type="submit">Delete</button>
                </form>
                </div> <!-- edit and delete buttons div start  -->
            </div><br> <!-- survey-item end -->';
        } //While end
    } //Else if end
    echo '

    <!-- Create survey button -->

    <button onclick="surveyCreate()" class="create-btn"> <b>Create New Survey</b>  </button>
    </div> <!-- created-surveys-list end -->
    
    <h1>Completed Surveys:</h1>
        <div class="created-surveys-list">';

    echo '
    </div> <!-- created-surveys-list end -->
    </div> <!-- modify-surveys end -->
    ';

    //If deleteSurvey is posted
    if (isset($_POST['deleteSurvey'])) {

        //Creates surveyID variable from the posted data
        $surveyID = mysqli_real_escape_string($conn, $_POST['survey_id']);

        //Delete from survey table where surveyID is equal
        $deleteQuery = "DELETE FROM survey WHERE surveyID = '$surveyID';";
       
        //If query was successful
        if (mysqli_query($conn, $deleteQuery)) { 
            echo "Survey deleted successfully!";
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //If end
}

function surveyEdit($name, $userID, $conn)
{ 
    //Initialize variables with default values
    $surveyName = '';
    $surveyDescription = '';
    $edittedSurveyID = '';

    //Checks if surveyID to edit is posted
    if (isset($_POST['editSurveyID'])) {

        //Access access and store the surveyID in a variable
        $edittedSurveyID = $_POST['editSurveyID'];

        //Store the data for the name and description from the survey table via the $surveyID
        $selectSurveyData = "SELECT `name`, `description` FROM `survey` WHERE `surveyID` ='$edittedSurveyID';";
        $resultSurveyData = mysqli_query($conn, $selectSurveyData);

        //If there is a result
        if ($resultSurveyData && mysqli_num_rows($resultSurveyData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSurveyData);

            //Info in the row to variables
            $surveyName = $row['name'];
            $surveyDescription = $row['description'];
        } //Inner if end
    } //Outter if end
    
    echo '
    <div class="edit-surveys">
    <h1>Hello <span>' . $name. '</span> this is the edit survey section</h1>';

    //Two forms, one for each part of the survey table: ( `name`, `description`)
    echo '
    <form action="" method="post">

        <input type="hidden" name="editSurveyID" value="' . $edittedSurveyID . '">

        <!--$surveyName data as a placeholder for the name form-->
        <label for="surveyName">Survey Name:</label>
        <br>
        <input type="text" name="surveyName" value="' . $surveyName . '" class="form-input" required>
        <br><br>

        <!--$surveyDescription data as a placeholder for the description form-->
        <label for="surveyDescription">Survey Description:</label>
        <br>
        <textarea name="surveyDescription" class="form-textarea" required>' . $surveyDescription . '</textarea>
        <br><br>

        <!--Submit form that posts updateSurvey-->
        <input type="submit" name="updateSurvey" value="Submit" class="form-btn">

        <!--Cancel button links to surveyModify.php-->
        <input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="Cancel" class="cancel-link">
        <br>
    </form>
    </div> <!-- edit-surveys end -->';

    //If updateSurvey is posted
    if (isset($_POST['updateSurvey'])) {

        //Create name and description variables from the posted data
        $surveyName = mysqli_real_escape_string($conn, $_POST['surveyName']);
        $surveyDescription = mysqli_real_escape_string($conn, $_POST['surveyDescription']);

        //Update the survey table row name and description column where the $surveyID is equal
        $editQuery = "UPDATE `survey` SET `name` = '$surveyName', `description` = '$surveyDescription' WHERE `survey`.`surveyID` = '$edittedSurveyID';";
        
        //If query was successful
        if (mysqli_query($conn, $editQuery)) {
            echo "update successful ";
            //header('location: surveyModify.php');
            //exit(); // Important to prevent further execution after the redirect
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //Outter if end
}

/**
 * Summary of opportunitySearch
 * @param mixed $name
 * @param mixed $conn
 * @return void
 */
function opportunitySearch($name, $conn)
{
    //Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    };
    echo '
    <div class="search-opportunities-box">
        <h1>Hello <span>' . $name . '</span> this is the search opportunity section</h1>
        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes">
            <p style="display: block;">Search By:</p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="opportunity-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Opportunity name"></div>
            <div class="opportunity-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="opportunitySearch" value="submit" type="submit">Search</button>
            </div> <!-- search-boxes end -->
        </form>

        <div class="opportunity-list">';

        //Select from all opportunities
        $select = "SELECT * FROM opportunity";
        $result = mysqli_query($conn, $select);

        //If there are no opportunities
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No opportunities were found';
        }

        //If there are opportunities
        else if (mysqli_num_rows($result) > 0) {

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {

                //Lists all opportunities
                echo '<div class="opportunity-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';
            } //While end
        } //Else if end

    echo'
        </div> <!-- opportunity-list end -->
        <div class="search-opportunity-list" style="display: none;">';

    //If opportunitySearch is posted
    if (isset($_POST['opportunitySearch'])) {
        echo '<script>hideAll();</script>';

        //Access searchName and searchTag variables from the posted data
        $searchName = mysqli_real_escape_string($conn, $_POST['searchName']);
        $searchTag = mysqli_real_escape_string($conn, $_POST['searchTag']);

        //Select from opportunity table where name variable is similar
        $select = "SELECT * FROM opportunity WHERE name LIKE '%$searchName%'";
        $result = mysqli_query($conn, $select);

        //If there are no opportunities
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No opportunities were found';
        }

        //If there are opportunities
        else if (mysqli_num_rows($result) > 0) { 

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {
                
                //Lists opportunities where name and tag is included in the search fields
                echo '<div class="opportunity-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';       
            } //While end
        } //Else if end
        unset($_POST['opportunitySearch']);
    } //If end
    echo'
        </div> <!-- search-opportunities-list end -->
    </div> <!-- search-opportunities-box end -->';
}

/**
 * Summary of opportunityCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function opportunityCreate($name, $userID, $conn)
{
    echo '
    <div class="create-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the create opportunity section</h1>

    <form action="" method="post"> <!-- form for create opportunity info start-->
		<label for="opportunityname"><b>Opportunity name:</b></label><br> <!-- opportunityName button -->
		<input type="text" id="opportunity_name" name="opportunity_name" required placeholder="Opportunity name">
		<br><br>
	
		<label for="opportunitydescription"><b>Opportunity description:</b></label><br> <!-- opportunityDescription button -->
		<input type="text" id="opportunity_description" name="opportunity_description" required placeholder="Opportunity description">
		<br><br>
		
		<label for="opportunitytags"><b>Opportunity tag(s):</b></label><br> <!-- opportunityTags button -->
		<input type="text" id="opportunity_tags" name="opportunity_tags" required placeholder="Opportunity tag(s)">
		<br><br>
	
		<input type="submit" name="createOpportunity" value="Create new opportunity" class="form-btn"> <!-- createOpportunity button -->
		<input type="button" onClick="window.location.href=\'opportunityModify.php\'" name="cancel" value="cancel" class="cancel-link"></input> <!-- cancel button links to opportunityModify.php-->
        <br><br>
	</form> <!-- form for create opportunity info end-->
    </div> <!-- create-opportunities end -->';

    //If createOpportunity is posted
    if (isset($_POST['createOpportunity'])) {

        //Create name and description variables from the posted data
        $name = mysqli_real_escape_string($conn, $_POST['opportunity_name']);
        $description = mysqli_real_escape_string($conn, $_POST['opportunity_description']);

        //Insert into opportunity table with the created variables
        $insert = "INSERT INTO `opportunity` (`opportunityID`, `ownerID`, `name`, `description`) VALUES (NULL, '$userID', '$name', '$description');";
        
        //If query was successful
        if (mysqli_query($conn, $insert)) {
            echo "Opportunity inserted successfully!";
        }

        //If query was not successful
        else { 
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createOpportunity']);
    } //If end
}

/**
 * Summary of opportunityModify
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function opportunityModify($name, $userID, $conn)
{
    echo '
    <div class="modify-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the manage opportunity section</h1>

    <h1> Created Opportunities: </h1>
    <div class="created-opportunities-list">';

    //Select from opportunity table where userID is equal
    $select = "SELECT * FROM opportunity WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editOpportunityID']);

    //If no opportunities were found
    if (mysqli_num_rows($result) == 0) {
        echo '<h1>No opportunities were found</h1>';
    }

    //If there are opportunities
    else if (mysqli_num_rows($result) > 0) {

        //While row in table exists via result
        while ($row = mysqli_fetch_assoc($result)) { 

            //Lists opportunities where where userID is equal
            echo '<div class="opportunity-item">
               <p> <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '</p>
               
                <div class="edit-delete-buttons"> <!-- edit and delete buttons div start  -->
            
                <form method="post" class="edit-method" action="opportunityEdit.php">
                   <input type="hidden" name="editOpportunityID" value="' . $row['opportunityID'] . '">
                   <button type="submit" name="editOpportunity">Edit</button>
                </form>';
   
                echo'
                <!-- deleteOpportunity button -->
                <form method="post" action="" class="delete-method" onsubmit="return confirm(\'Are you sure you want to delete this opportunity?\');">
                    <input type="hidden" name="opportunity_id" value="' . $row['opportunityID'] . '">
                    <button name="deleteOpportunity" value="submit" type="submit">Delete</button>
                </form>
                </div> <!-- edit and delete buttons div start  -->
            </div><br> <!-- opportunity-item end -->';
        } //While end
    } //Else if end
    echo '

    <!-- Create opportunity button -->
    <button onclick="opportunityCreate()" class="create-btn"> <b>Create New Opportunity</b>  </button>
    </div> <!-- created-opportunities-list end -->
    
    <h1>Joined Opportunities:</h1>
        <div class="created-opportunities-list">';

    echo '
    </div> <!-- created-opportunities-list end -->
    </div> <!-- modify-opportunities end -->
    ';

    //If deleteOpportunity is posted
    if (isset($_POST['deleteOpportunity'])) {

        //Creates opportunityID variable from the posted data
        $opportunityID = mysqli_real_escape_string($conn, $_POST['opportunity_id']);

        //Delete from opportunity table where opportunityID is equal
        $deleteQuery = "DELETE FROM opportunity WHERE opportunityID = '$opportunityID';";
       
        //If query was successful
        if (mysqli_query($conn, $deleteQuery)) { 
            echo "Opportunity deleted successfully!";
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //If end
}

function opportunityEdit($name, $userID, $conn)
{ 
    //Initialize variables with default values
    $opportunityName = '';
    $opportunityDescription = '';
    $edittedOpportunityID = '';

    //Checks if opportunityID to edit is posted
    if (isset($_POST['editOpportunityID'])) {

        //Access access and store the opportunityID in a variable
        $edittedOpportunityID = $_POST['editOpportunityID'];

        //Store the data for the name and description from the opportunity table via the $opportunityID
        $selectOpportunityData = "SELECT `name`, `description` FROM `opportunity` WHERE `opportunityID` ='$edittedOpportunityID';";
        $resultOpportunityData = mysqli_query($conn, $selectOpportunityData);

        //If there is a result
        if ($resultOpportunityData && mysqli_num_rows($resultOpportunityData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultOpportunityData);

            //Info in the row to variables
            $opportunityName = $row['name'];
            $opportunityDescription = $row['description'];
        } //Inner if end
    } //Outter if end
    
    echo '
    <div class="edit-opportunities">
    <h1>Hello <span>' . $name. '</span> this is the edit opportunity section</h1>';

    //Two forms, one for each part of the opportunity table: ( `name`, `description`)
    echo '
    <form action="" method="post">
        <input type="hidden" name="editOpportunityID" value="' . $edittedOpportunityID . '">

        <!--$opportunityName data as a placeholder for the name form-->
        <label for="opportunityName">Opportunity Name:</label>
        <br>
        <input type="text" name="opportunityName" value="' . $opportunityName . '" class="form-input" required>
        <br><br>

        <!--$opportunityDescription data as a placeholder for the description form-->
        <label for="opportunityDescription">Opportunity Description:</label>
        <br>
        <textarea name="opportunityDescription" class="form-textarea" required>' . $opportunityDescription . '</textarea>
        <br><br>

        <!--Submit form that posts updateOpportunity-->
        <input type="submit" name="updateOpportunity" value="Submit" class="form-btn">

        <!--Cancel button links to opportunityModify.php-->
        <input type="button" onClick="window.location.href=\'opportunityModify.php\'" name="cancel" value="Cancel" class="cancel-link">
        <br>
    </form>
    </div> <!-- edit-opportunities end -->';

    //If updateOpportunity is posted
    if (isset($_POST['updateOpportunity'])) {

        //Create name and description variables from the posted data
        $opportunityName = mysqli_real_escape_string($conn, $_POST['opportunityName']);
        $opportunityDescription = mysqli_real_escape_string($conn, $_POST['opportunityDescription']);

        //Update the opportunity table row name and description column where the $opportunityID is equal
        $editQuery = "UPDATE `opportunity` SET `name` = '$opportunityName', `description` = '$opportunityDescription' WHERE `opportunity`.`opportunityID` = '$edittedOpportunityID';";
        
        //If query was successful
        if (mysqli_query($conn, $editQuery)) {
            echo "update successful ";
            //header('location: opportunityModify.php');
            //exit(); // Important to prevent further execution after the redirect
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //Outter if end
}


/**
 * Summary of supportGroupSearch
 * @param mixed $name
 * @param mixed $conn
 * @return void
 */
function supportGroupSearch($name, $conn)
{
    //Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    };
    echo '
    <div class="search-supportGroups-box">
        <h1>Hello <span>' . $name . '</span> this is the search support group section</h1>
        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes">
            <p style="display: block;">Search By:</p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="supportGroup-search-name-box"><label for="search">Name:</label><input type="text" name="searchName" placeholder="Support group name"></div>
            <div class="supportGroup-search-tag-box"><label for="tag"> Tags:</label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="supportGroupSearch" value="submit" type="submit">Search</button>
            </div> <!-- search-boxes end -->
        </form>

        <div class="supportGroup-list">';

        //Select from all support groups
        $select = "SELECT * FROM supportgroup";
        $result = mysqli_query($conn, $select);

        //If there are no support groups
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No support groups were found';
        }

        //If there are support groups
        else if (mysqli_num_rows($result) > 0) {

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {

                //Lists all support groups
                echo '<div class="supportGroup-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';
            } //While end
        } //Else if end

    echo'
        </div> <!-- supportGroup-list end -->
        <div class="search-supportGroup-list" style="display: none;">';

    //If supportGroupSearch is posted
    if (isset($_POST['supportGroupSearch'])) {
        echo '<script>hideAll();</script>';

        //Access searchName and searchTag variables from the posted data
        $searchName = mysqli_real_escape_string($conn, $_POST['searchName']);
        $searchTag = mysqli_real_escape_string($conn, $_POST['searchTag']);

        //Select from supportgroup table where name variable is similar
        $select = "SELECT * FROM supportgroup WHERE name LIKE '%$searchName%'";
        $result = mysqli_query($conn, $select);

        //If there are no support groups
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No support groups were found';
        }

        //If there are support groups
        else if (mysqli_num_rows($result) > 0) { 

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {
                
                //Lists support groups where name and tag is included in the search fields
                echo '<div class="supportGroup-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                echo '</div><br>';       
            } //While end
        } //Else if end
        unset($_POST['supportGroupSearch']);
    } //If end
    echo'
        </div> <!-- search-supportGroups-list end -->
    </div> <!-- search-supportGroups-box end -->';
}

/**
 * Summary of supportGroupCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupCreate($name, $userID, $conn)
{
    echo '
    <div class="create-supportGroups">
    <h1>Hello <span>' . $name . '</span> this is the create support group section</h1>

    <form action="" method="post"> <!-- form for create supportGroup info start-->
		<label for="supportGroupname"><b>Support group name:</b></label><br> <!-- supportGroupName button -->
		<input type="text" id="supportGroup_name" name="supportGroup_name" required placeholder="Support group name">
		<br><br>
	
		<label for="supportGroupdescription"><b>Support Group description:</b></label><br> <!-- supportGroupDescription button -->
		<input type="text" id="supportGroup_description" name="supportGroup_description" required placeholder="Support group description">
		<br><br>
		
		<label for="supportGrouptags"><b>Support group tag(s):</b></label><br> <!-- supportGroupTags button -->
		<input type="text" id="supportGroup_tags" name="supportGroup_tags" required placeholder="Support group tag(s)">
		<br><br>
	
		<input type="submit" name="createSupportGroup" value="Create new support group" class="form-btn"> <!-- createSupportGroup button -->
		<input type="button" onClick="window.location.href=\'supportGroupModify.php\'" name="cancel" value="cancel" class="cancel-link"></input> <!-- cancel button links to supportGroupModify.php-->
        <br><br>
	</form> <!-- form for create supportGroup info end-->
    </div> <!-- create-supportGroups end -->';

    //If createSupportGroup is posted
    if (isset($_POST['createSupportGroup'])) {

        //Create name and description variables from the posted data
        $name = mysqli_real_escape_string($conn, $_POST['supportGroup_name']);
        $description = mysqli_real_escape_string($conn, $_POST['supportGroup_description']);

        //Insert into supportgroup table with the created variables
        $insert = "INSERT INTO `supportgroup` (`supportGroupID`, `ownerID`, `name`, `description`) VALUES (NULL, '$userID', '$name', '$description');";
        
        //If query was successful
        if (mysqli_query($conn, $insert)) {
            echo "Support Group inserted successfully!";
        }

        //If query was not successful
        else { 
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createSupportGroup']);
    } //If end
}

/**
 * Summary of supportGroupModify
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupModify($name, $userID, $conn)
{
    echo '
    <div class="modify-supportGroups">
    <h1>Hello <span>' . $name . '</span> this is the manage support group section</h1>

    <h1> Created Support groups: </h1>
    <div class="created-supportGroups-list">';

    //Select from supportgroup table where userID is equal
    $select = "SELECT * FROM supportgroup WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editSupportGroupID']);

    //If no support groups were found
    if (mysqli_num_rows($result) == 0) {
        echo '<h1>No support groups were found</h1>';
    }

    //If there are support groups
    else if (mysqli_num_rows($result) > 0) {

        //While row in table exists via result
        while ($row = mysqli_fetch_assoc($result)) { 

            //Lists support groups where where userID is equal
            echo '<div class="supportGroup-item">
               <p> <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '</p>
               
                <div class="edit-delete-buttons"> <!-- edit and delete buttons div start  -->
            
                <form method="post" class="edit-method" action="supportGroupEdit.php">
                   <input type="hidden" name="editSupportGroupID" value="' . $row['supportGroupID'] . '">
                   <button type="submit" name="editSupportGroup">Edit</button>
                </form>';
   
                echo'
                <!-- deleteSupportGroup button -->
                <form method="post" action="" class="delete-method" onsubmit="return confirm(\'Are you sure you want to delete this support group?\');">
                    <input type="hidden" name="supportGroup_id" value="' . $row['supportGroupID'] . '">
                    <button name="deleteSupportGroup" value="submit" type="submit">Delete</button>
                </form>
                </div> <!-- edit and delete buttons div start  -->
            </div><br> <!-- supportGroup-item end -->';
        } //While end
    } //Else if end
    echo '

    <!-- Create supportGroup button -->
    <button onclick="supportGroupCreate()" class="create-btn"> <b>Create New Support Group</b>  </button>
    </div> <!-- created-supportGroups-list end -->
    
    <h1>Joined Support Groups:</h1>
        <div class="created-supportGroups-list">';

    echo '
    </div> <!-- created-supportGroups-list end -->
    </div> <!-- modify-supportGroups end -->
    ';

    //If deleteSupportGroup is posted
    if (isset($_POST['deleteSupportGroup'])) {

        //Creates supportGroupID variable from the posted data
        $supportGroupID = mysqli_real_escape_string($conn, $_POST['supportGroup_id']);

        //Delete from supportgroup table where supportGroupID is equal
        $deleteQuery = "DELETE FROM supportgroup WHERE supportGroupID = '$supportGroupID';";
       
        //If query was successful
        if (mysqli_query($conn, $deleteQuery)) { 
            echo "Support group deleted successfully!";
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //If end
}

function supportGroupEdit($name, $userID, $conn)
{ 
    //Initialize variables with default values
    $supportGroupName = '';
    $supportGroupDescription = '';
    $edittedSupportGroupID = '';

    //Checks if supportGroupID to edit is posted
    if (isset($_POST['editSupportGroupID'])) {

        //Access access and store the supportGroupID in a variable
        $edittedSupportGroupID = $_POST['editSupportGroupID'];

        //Store the data for the name and description from the supportgroup table via the $supportGroupID
        $selectSupportGroupData = "SELECT `name`, `description` FROM `supportgroup` WHERE `supportGroupID` ='$edittedSupportGroupID';";
        $resultSupportGroupData = mysqli_query($conn, $selectSupportGroupData);

        //If there is a result
        if ($resultSupportGroupData && mysqli_num_rows($resultSupportGroupData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSupportGroupData);

            //Info in the row to variables
            $supportGroupName = $row['name'];
            $supportGroupDescription = $row['description'];
        } //Inner if end
    } //Outter if end
    
    echo '
    <div class="edit-supportGroups">
    <h1>Hello <span>' . $name. '</span> this is the edit support group section</h1>';

    //Two forms, one for each part of the supportgroup table: ( `name`, `description`)
    echo '
    <form action="" method="post">
        <input type="hidden" name="editSupportGroupID" value="' . $edittedSupportGroupID . '">

        <!--$supportGroupName data as a placeholder for the name form-->
        <label for="supportGroupName">Support Group Name:</label>
        <br>
        <input type="text" name="supportGroupName" value="' . $supportGroupName . '" class="form-input" required>
        <br><br>

        <!--$supportGroupDescription data as a placeholder for the description form-->
        <label for="supportGroupDescription">SupportGroup Description:</label>
        <br>
        <textarea name="supportGroupDescription" class="form-textarea" required>' . $supportGroupDescription . '</textarea>
        <br><br>

        <!--Submit form that posts updateSupportGroup-->
        <input type="submit" name="updateSupportGroup" value="Submit" class="form-btn">

        <!--Cancel button links to supportGroupModify.php-->
        <input type="button" onClick="window.location.href=\'supportGroupModify.php\'" name="cancel" value="Cancel" class="cancel-link">
        <br>
    </form>
    </div> <!-- edit-supportGroups end -->';

    //If updateSupportGroup is posted
    if (isset($_POST['updateSupportGroup'])) {

        //Create name and description variables from the posted data
        $supportGroupName = mysqli_real_escape_string($conn, $_POST['supportGroupName']);
        $supportGroupDescription = mysqli_real_escape_string($conn, $_POST['supportGroupDescription']);

        //Update the supportgroup table row name and description column where the $supportGroupID is equal
        $editQuery = "UPDATE `supportgroup` SET `name` = '$supportGroupName', `description` = '$supportGroupDescription' WHERE `supportgroup`.`supportGroupID` = '$edittedSupportGroupID';";
        
        //If query was successful
        if (mysqli_query($conn, $editQuery)) {
            echo "update successful ";
            //header('location: supportGroupModify.php');
            //exit(); // Important to prevent further execution after the redirect
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //Outter if end
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
 * @param mixed $name,$userID,$conn
 * @return void
 */
function studyModify($name,$userID,$conn)
{
    echo '
    <div class="modify-surveys">
    <h1>Hello <span>' . $name . '</span> this is the modify studies section</h1>

    <h1>These are the studies you have created:</h1>
    <div class="created-surveys-list">';
    $select = "SELECT * FROM study WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editSurveyID']);
    if (mysqli_num_rows($result) == 0) { // If no surveys were found
        echo '<h1>No studies were found</h1>';
    } else if (mysqli_num_rows($result) > 0) { // If there are surveys
        while ($row = mysqli_fetch_assoc($result)) {
            /* Added styling to the queried search results */
            echo '
            <div class="survey-item">
                <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '<br><b>Date:</b> ' . $row['date'] . '<br><b>Location:</b> ' . $row['location'] . '<br><b>Compensation:</b> ' . $row['compensation'].'
            </div> <!-- survey-item end -->
            <br>';

            echo '
            <form method="post" action="studyEdit.php">
                <input type="hidden" name="editSurveyID" value="' . $row['studyID'] . '">
				<button type="submit" name="editStudy" class="edit-button">Edit</button>
            </form>';
            echo'
            <form method="post" action="" onsubmit="return confirm(\'Are you sure you want to delete this survey?\');">
                  <input type="hidden" name="study_id" value="' . $row['studyID'] . '">
                  <button name="deleteStudy" value="submit" type="submit">Delete</button>
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


    if (isset($_POST['deleteStudy'])) {
        // Handle the delete logic here
        $studyID = mysqli_real_escape_string($conn, $_POST['study_id']);
        $deleteQuery = "DELETE FROM study WHERE studyID = '$studyID';";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Study deleted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

/**
 * Summary of studyDelete - used for editing a study
 * @param mixed $name, $userID, $conn
 * @return void
 */
function studyDelete($name, $userID, $conn)
{
	// Initialize variables with default values
	$stu_name = '';
	$stu_desc = '';
	$stu_loc = '';
	$stu_time = '';
	$stu_com = '';
	$stu_tags = '';
    $edittedStudyID = '';
	
    if (isset($_POST['editSurveyID'])) {
        // Access the surveyID
        $edittedStudyID = $_POST['editSurveyID'];

        // Fetch survey data from the database using the $edittedSurveyID
        $selectStudyData = "SELECT `name`, `description`, `location`, `date`, `compensation` FROM `study` WHERE `studyID` ='$edittedStudyID';";
        $resultStudyData = mysqli_query($conn, $selectStudyData);

        if ($resultStudyData && mysqli_num_rows($resultStudyData) > 0) {
            $row = mysqli_fetch_assoc($resultStudyData);
			$stu_name = $row['name'];
			$stu_desc = $row['description'];
			$stu_loc = $row['location'];
			$stu_time = $row['date'];
			$stu_com = $row['compensation'];
			$stu_tags = '';
        }
    }
    
    echo '
    <h1>Hello <span>' . $name. ' '.$edittedStudyID.'</span> this is the edit study section</h1>';

    echo '
    <form action="" method="post">
    <input type="hidden" name="editSurveyID" value="' . $edittedStudyID . '">
    <label for="studyName">Survey Name:</label>
    <input type="text" name="studyName" value="' . $stu_name . '" class="form-input" required>
    <br>
    <label for="surveyDescription">Survey Description:</label>
    <textarea name="studyDescription" class="form-textarea" required>' . $stu_desc . '</textarea>
    <br>
	<label for="studyLocation">Study Location:</label>
    <textarea name="studyLocation" class="form-textarea" required>' . $stu_loc . '</textarea>
    <br>
	<label for="studyTime">Study Time:</label>
    <textarea name="studyTime" class="form-textarea" required>' . $stu_time . '</textarea>
    <br>
	<label for="studyCompensation">Study Compensation:</label>
    <textarea name="studyCompensation" class="form-textarea" required>' . $stu_com . '</textarea>
    <br>
    <input type="submit" name="updateStudy" value="Submit" class="form-btn"> 
    <input type="button" onClick="window.location.href=\'study.php\'" name="cancel" value="Cancel" class="cancel-link">
    <br>

	</form>
    ';

    if (isset($_POST['updateStudy'])) {
        // Handle the edit logic here
        $stu_name = mysqli_real_escape_string($conn, $_POST['studyName']);
        $stu_desc = mysqli_real_escape_string($conn, $_POST['studyDescription']);
		$stu_loc = mysqli_real_escape_string($conn, $_POST['studyLocation']);
		$stu_time = mysqli_real_escape_string($conn, $_POST['studyTime']);
		$stu_com = mysqli_real_escape_string($conn, $_POST['studyCompensation']);
		$stu_tags = '';
        echo $edittedStudyID;
        $editQuery = "UPDATE `study` SET `name`='$stu_name',`description`='$stu_desc',`location`='$stu_loc',`date`='$stu_time',`compensation`='$stu_com' WHERE `study`.`studyID` = '$edittedStudyID';";
        
        if (mysqli_query($conn, $editQuery)) {
            echo "update successful ";
            //header('location: surveyModify.php');
            //exit(); // Important to prevent further execution after the redirect
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    
}

echo '<script src="functions.js"></script>';
?>
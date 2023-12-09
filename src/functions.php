<?php
//PHP coded by Jeremy
//Implements the JavaScript functions in functions.js
echo '<script src="functions.js"></script>';
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

/* TEST Function */
/* Created by Geary */
function getUserData($conn, $email) {
    // email that will be used to execute SQL query
    $email = mysqli_real_escape_string($conn, $email);
    
    // The query
    $select = "SELECT * FROM user WHERE email = '$email'";
    // queried result
    $result = mysqli_query($conn, $select);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;  // Return the user data
    } else {
        return false; // Return false if no data is found or an error occurs
    }
}

/**
 * Uses the input to return a result through $conn
 * 
 * @param mixed $conn
 * @return bool|mysqli_result
 */
function validate($conn)
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Retrieve the hashed password from the database
    $select = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    // if query is successful and there are rows
   if ($result && $row = mysqli_fetch_array($result)) {
        // retrieval of the hashed password

        $hashedPasswordFromDB = $row['password'];

        // Verify the entered password using password_verify
        // If password is correct
       if (password_verify(trim($password), $hashedPasswordFromDB)) {

            // password is correct
            echo "Congratulations!The password is correct!";
            return true; 
        }
    }
    // Either email doesn't exist or password is incorrect
    return false; 
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
                <img src="./images/eagle.png" class="logo-img">
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
    elseif($pageName=='SurveysComplete') //Navbar for surveysComplete start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';
                surveyComplete($name, $userID, $conn); //Displays the surveyComplete content
                echo '
            </div>
        </div>';
    }//Navbar for surveysComplete end
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
    elseif($pageName=='SurveysAnswerEdit') //Navbar for surveysAnswerEdit start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';
                surveyAnswerEdit($name, $userID, $conn); //Displays the surveyAnswerEdit content
                echo '
            </div>
        </div>';
    }//Navbar for surveysAnswerEdit end
    elseif($pageName=='SurveysView') //Navbar for surveysView start
    {
        $pageNameDisplay='Surveys';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="survey.php">Search ' . $pageNameDisplay . '</a>
            <a href="surveyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';
                surveyView($name, $userID, $conn); //Displays the surveyView content
                echo '
            </div>
        </div>';
    }//Navbar for surveysView end
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
                    opportunitySearch($name, $userID, $conn);  //Displays the opportunitySearch content
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
    elseif($pageName=='OpportunitiesView') //Navbar for opportunitiesView start
    {
        $pageNameDisplay='Opportunities';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="opportunity.php">Search ' . $pageNameDisplay . '</a>
            <a href="opportunityModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                opportunityView($name, $userID, $conn); //Displays the opportunitityView content
                echo '
            </div>
        </div>';
    }//Navbar for opportunitiesView end
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
                    supportGroupSearch($name, $userID, $conn);  //Displays the opportunitySearch content
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
    elseif($pageName=='SupportGroupsView') //Navbar for supportGroupView start
    {
        $pageNameDisplay='Support Groups';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="supportGroup.php">Search ' . $pageNameDisplay . '</a>
            <a href="supportGroupModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                supportGroupView($name, $userID, $conn); //Displays the supportGroupView content
                echo '
            </div>
        </div>';
    }//Navbar for supportGroupView end
    elseif($pageName=='SupportGroupsPost') //Navbar for supportGroupPost start
    {
        $pageNameDisplay='Support Groups';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="supportGroup.php">Search ' . $pageNameDisplay . '</a>
            <a href="supportGroupModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                supportGroupPost($name, $userID, $conn); //Displays the supportGroupPost content
                echo '
            </div>
        </div>';
    }//Navbar for supportGroupPost end
    elseif($pageName=='SupportGroupsPostCreate') //Navbar for supportGroupPostCreate start
    {
        $pageNameDisplay='Support Groups';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="supportGroup.php">Search ' . $pageNameDisplay . '</a>
            <a href="supportGroupModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                supportGroupPostCreate($name, $userID, $conn); //Displays the supportGroupPostCreate content
                echo '
            </div>
        </div>';
    }//Navbar for supportGroupPostCreate end
    elseif($pageName=='SupportGroupsPostComment') //Navbar for supportGroupPostComment start
    {
        $pageNameDisplay='Support Groups';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="supportGroup.php">Search ' . $pageNameDisplay . '</a>
            <a href="supportGroupModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                supportGroupPostComment($name, $userID, $conn); //Displays the supportGroupPostComment content
                echo '
            </div>
        </div>';
    }//Navbar for supportGroupPost end
    if($pageName=='Studies') //Navbar for surveys start
    {
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
                <a href="study.php">Search ' . $pageName . '</a>
                <a href="studyModify.php">Manage ' . $pageName . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->
                <div class="search-studies">'; //Container for searchStudy module
                    studySearch($name, $userID, $conn);  //Displays the studySearch content
                    echo '
                </div>
            </div>
        </div>';
    } //Navbar for studies end
    elseif($pageName=='StudiesModify') //Navbar for studiesModify start
    {
        $pageNameDisplay='Studies';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="study.php">Search ' . $pageNameDisplay . '</a>
            <a href="studyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>
            <div class="page-content">  <!-- Container for all the content -->';
                studyModify($name, $userID, $conn); //Displays the studyModify content   
                studyCreate($name, $userID, $conn); //Displays the studyCreate content
                echo '
            </div>
        </div>';
    }//Navbar for studiesModify end
    elseif($pageName=='StudiesEdit') //Navbar for studiesEdit start
    {
        $pageNameDisplay='Studies';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="study.php">Search ' . $pageNameDisplay . '</a>
            <a href="studyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';
                studyEdit($name, $userID, $conn); //Displays the studyEdit content
                echo '
            </div>
        </div>';
    }//Navbar for studiesEdit end
    elseif($pageName=='StudiesView') //Navbar for studiesView start
    {
        $pageNameDisplay='Studies';
        echo '
        <div class="navbar-content-container">
            <div class="navbar"> <!-- Links for each module -->
            <a href="study.php">Search ' . $pageNameDisplay . '</a>
            <a href="studyModify.php">Manage ' . $pageNameDisplay . '</a>
            </div>

            <div class="page-content">  <!-- Container for all the content -->';
                studyView($name, $userID, $conn); //Displays the studyView content
                echo '
            </div>
        </div>';
    }//Navbar for studiesView end
    elseif($pageName=='Account Page') { //Navbar for Account Page start

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
                accountPageDisplay($conn,$email, $user_type, $name, $last_name, $userID);
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
function accountPageDisplay($conn, $email, $user_type, $first_name, $last_name, $userID) { //Created by Geary
    echo '
        <div class="account-page-box">';    // Account page div element
        echo '
        <h1>Welcome to the Account Page.</h1>	<!-- Header for the account page -->
        
        <!--Profile Information for account page -->

        <div class="profile-header">
        <img class="profile-pic" src="./images/profile_pic.png" alt="Profile pic"><br>
        </div><br>
        <div class="header-links">
      
        <!-- Functionality still being worked on  
       <form class="upload-form" action=""  method="POST" enctype="multipart/form-data">
        <label for="img-form">Choose File</label><input id="img-form" type="file" name="file"/> 
            <button class="submit-form" type="submit" name="upload"> UPLOAD </button>       
        </form>
        -->
        
            <a href="#/_edit_info" id="edit-link" onclick="editUserAccountInput()"> Edit </a>
            </div>
        <div class="profile-information">
        <form class="input-form" action="" method="POST"> <!-- Form to record edited user data -->
            <label for="myInput0">First Name: </label><input type="text" name="firstname" id="myInput0" class="myInput" value="'. $first_name .'" readonly><br><br>
            <label for="myInput1">Last Name: </label><input type="text" id="myInput1" name="lastname" class="myInput" value="'. $last_name .'" readonly><br><br>
            <label for="myInput2">Email:</label><input type="text" id="myInput2" name="email" class="myInput" value="'. $email .'" readonly><br><br>
            <label for="myInput3">User-Type:</label><br>
                <select id="myInput3" name="user_type" class="myInput" disabled>';

            // Displaying the types of usertypes and displaying them
                    $list_of_usertypes = ['person', 'researcher'];  // list of different usertyoes to be displayed in select dropdown
                    $indexOfUsertype = array_search($user_type,$list_of_usertypes); // used to find the index
                    if($indexOfUsertype === 0) {
                        echo '<option value="'.$user_type.'"> '.$user_type.'</option>
                        <option value="'.$list_of_usertypes[1].'">'.$list_of_usertypes[1].'</option>';
                    } else {
                        echo '<option value="'.$list_of_usertypes[1].'">'.$list_of_usertypes[1].'</option>
                        <option value="'.$list_of_usertypes[0].'">'.$list_of_usertypes[0].'</option>';
                    }

                     echo '
                    </select> 
                <div class="button-list">	<! -- Buttons -->
                    <button type="submit" class="save-btn" name="save-button"> Save </button>  <!-- TEST 1 -->
                    <button class="cancel-btn"> Cancel </button>
                    </div>
             </form> <!-- End of form -->
            </div> <!-- End of profile-information div element -->

        
        </div>';    // Account page div element ending 

  
	/* This is where the updating of the information is, it is recorded by isset($_POST[]). From there there is an SQL update statement to update
	the database with the new values. The session variables are also updated as well, so the newly updated information can display throughout the other pages
	*/

        if(isset($_POST["save-button"])) {
            $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);    // firstname
            $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);      // lastname
            $email = mysqli_real_escape_string($conn, $_POST['email']);		    // email
            $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);	   // user_type
    
	    // Update SQL statement
            $editUser = "UPDATE `user` SET `firstname` = '$first_name', `lastname` = '$last_name', `email`  = '$email', `user_type` = '$user_type' WHERE `userID` = '$userID';";
            
            if (mysqli_query($conn, $editUser)) {
                // if researcher name
                if (isset($_SESSION['researcher_name'])) {
                    $_SESSION['researcher_name'] = $first_name;		// updated researcher_name with $first_name
                }
            
                // else if person name
                elseif (isset($_SESSION['person_name'])) {
                    $_SESSION['person_name'] = $first_name;		// updated person_name with $first_name
                }
                
                $_SESSION['lastName'] = $last_name;
                $_SESSION['email'] = $email;				// updated email with $email
                $_SESSION['user_type'] = $user_type;			// updated user_type with $user_type


                echo "Record updated successfully!";
                echo " <script>
                updateUserAccountInfo('$first_name', '$last_name', '$email', '$user_type');
                </script>
                ";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        
        } 
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
function surveySearch($name, $conn) {
    // Used to display errors
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
            <p style="display: block;"><b>Search By:</b></p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="survey-search-name-box"><label for="search"><b>Name:</b></label><input type="text" name="searchName" placeholder="Survey name"></div>
            <div class="survey-search-tag-box"><label for="tag"><b>Tags:</b></label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="surveySearch" value="submit" type="submit">Search</button>
            </div> <!-- search-boxes end -->
        </form>

        <div class="survey-list">';

        // Select from all surveys
        $select = "SELECT * FROM survey";
        $result = mysqli_query($conn, $select);

        // If there are no surveys
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No surveys were found';
        }

        // If there are surveys
        else if (mysqli_num_rows($result) > 0) {

            // While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {

                // Lists all surveys
                echo '
                <div class="survey-item">
                    <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'].'
                    <br><br>
                    
                    <div class="view-button">
                        <form method="post" class="complete-method" action="surveyComplete.php">
                            <input type="hidden" name="completeSurveyID" value="' . $row['surveyID'] . '">
                            <button type="submit" name="completeSurvey">Complete survey</button>
                        </form>
                    </div>
                </div>
                <br>';
            } // While end
        } // Else if end

    echo'
        </div> <!-- survey-list end -->
        <div class="search-survey-list" style="display: none;">';

    // If surveySearch is posted
    if (isset($_POST['surveySearch'])) {
        echo '<script>hideAll();</script>';

        // Access searchName and searchTag variables from the posted data
        $searchName = mysqli_real_escape_string($conn, $_POST['searchName']);
        $searchTag = mysqli_real_escape_string($conn, $_POST['searchTag']);

        // Select from survey table where name variable is similar
        $select = "SELECT * FROM survey WHERE name LIKE '%$searchName%'";
        $result = mysqli_query($conn, $select);

        // If there are no surveys
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No surveys were found';
        }

        //If there are surveys
        else if (mysqli_num_rows($result) > 0) { 

            // While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {

                // Lists surveys where name and tag is included in the search fields
                echo '<div class="survey-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '
                <br><br>
                    
                <div class="view-button">
                    <!-- Complete survey button -->
                    <button onclick="surveyComplete()" class="complete-btn"> <b>Complete Survey</b>  </button>
                </div>
            </div>
            <br>';
            } // While end
        } // Else if end
        unset($_POST['surveySearch']);
    } // If end
    echo'
        </div> <!-- search-surveys-list end -->
    </div> <!-- search-surveys-box end -->
    </div>';
}

/**
 * Summary of surveyComplete
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyComplete($name, $userID, $conn) {
    
    // Initialize variables with default values
    $surveyName = '';
    $surveyDescription = '';
    $submittedSurveyID = '';

    // Checks if surveyID to edit is posted
    if (isset($_POST['completeSurveyID'])) {

        // Access and store the surveyID in a variable
        $submittedSurveyID = $_POST['completeSurveyID'];
        
        // Store the data for the name and description from the survey table via the $surveyID
        $selectedSurveyData = "SELECT `name`, `description` FROM `survey` WHERE `surveyID` = '$submittedSurveyID';";
        $resultSurveyData = mysqli_query($conn, $selectedSurveyData);
        $selectedSurveyQuestions = "SELECT *  FROM `surveyquestion` WHERE `surveyID` = '$submittedSurveyID';";
        $resultSurveyQuestions = mysqli_query($conn, $selectedSurveyQuestions);

        // If there is a result for the name & description
        if ($resultSurveyData && mysqli_num_rows($resultSurveyData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSurveyData);

            //Info in the row to variables
            $surveyName = $row['name'];
            $surveyDescription = $row['description'];
        }

        // If there is a result for the survey questions
        if ($resultSurveyQuestions && mysqli_num_rows($resultSurveyQuestions) > 0) {

            // Gets the number of rows & used as counter to track the number of questions
            $questionCounter = mysqli_num_rows($resultSurveyQuestions);
        }
    } // Outer if end
    
    echo '
    <div class="complete-surveys">
        <h1>Hello <span>' . $name . '</span>, this is the complete survey section</h1>';

        // Display survey questions and answer input-forms here

        echo '
        <form action="" method="post">
    
            <!--$submittedSurveyID for submitting-->
            <input type="hidden" name="completeSurveyID" value="' . $submittedSurveyID . '">
    
            
            <label for="surveyName"><b>Survey Name:</b><br>' . $surveyName . '</label>
            <br><br>
            
            <label for="surveyDescription"><b>Survey Description:</b><br>' . $surveyDescription . '</label>
            <br><br>';

            // If there is questions
            if (mysqli_num_rows($resultSurveyQuestions) > 0) {
                for ($i = 1; $i <= $questionCounter; $i++) {

                    // Fetch the question data for the current iteration
                    $questionData = mysqli_fetch_assoc($resultSurveyQuestions);
                
                    echo '
                    <label for="question' . $i . '"><b>Question ' . $i . ':</b> ' . $questionData['question'] . '</label>
                    <br>
                    <input type="text" name="response[]" class="form-input" placeholder="Enter answer here">
                    <br><br>';
                }
            }

            // If there is no questions
            else {
                echo "There are no questions to answer!<br><br>";
            }

        echo '
            <!--Submit form that posts submitSurvey-->
            <input type="submit" name="submitSurvey" value="Submit" class="form-btn">
    
            <!--Cancel button links to surveyModify.php-->
            <input type="button" onClick="window.location.href=\'survey.php\'" name="cancel" value="Cancel" class="cancel-link">
            <br>
        </form>
    </div> <!-- complete-surveys end -->';

    // If submitSurvey is posted
    if (isset($_POST['submitSurvey'])) {

        // Reset the result set pointer to the beginning
        mysqli_data_seek($resultSurveyQuestions, 0);

        // Update questions in the surveyquestion table
        foreach ($_POST['response'] as $responseIndex => $responseText) {
            // Fetch the question data for the current iteration
            $questionData = mysqli_fetch_assoc($resultSurveyQuestions);

            // Insert a new response
            $insertResponseQuery = "INSERT INTO `surveyresponse` (`responseID`, `surveyID`, `questionID`, `response`) VALUES (NULL, '$submittedSurveyID', '{$questionData['questionID']}', '$responseText');";

            // If $insertResponseQuery was successful
            if (mysqli_query($conn, $insertResponseQuery)) {
                // Get the responseID of the inserted record
                $responseID = mysqli_insert_id($conn);

                // Check if the responseID is valid
                if ($responseID > 0) {
                    echo "Response inserted successfully <br>";

                    $userSurveyQuery = "INSERT INTO `user_survey` (`userID`, `surveyID`, `questionID`, `responseID`) VALUES ('$userID', '$submittedSurveyID', '{$questionData['questionID']}', '$responseID');";

                    // If query was not successful
                    if (!mysqli_query($conn, $userSurveyQuery)) {
                        echo "Error inserting user_survey record: " . mysqli_error($conn) . "<br>";
                    }
                } 

                // If the responseID is not valid
                else {
                    echo "Error getting responseID <br>";
                }
            } 
            
            // If $insertResponseQuery was successful
            else {
                echo "Error inserting response: " . mysqli_error($conn) . "<br>";
            }
        } // Foreach end
    } // If end
}

/**
 * Summary of surveyCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyCreate($name, $userID, $conn) {
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

    // If createSurvey is posted
    if (isset($_POST['createSurvey'])) {

        // Create name and description variables from the posted data
        $surveyID = mysqli_real_escape_string($conn, $_POST['surveyID']);
        $name = mysqli_real_escape_string($conn, $_POST['survey_name']);
        $description = mysqli_real_escape_string($conn, $_POST['survey_description']);

        // Insert into survey table with the created variables
        $insert = "INSERT INTO `survey` (`surveyID`, `ownerID`, `name`, `description`) VALUES (NULL, '$userID', '$name', '$description');";
        
        // If query was successful
        if (mysqli_query($conn, $insert)) {
            echo "Survey inserted successfully!";
        }

        // If query was not successful
        else { 
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createSurvey']);
    } // If end
}

/**
 * Summary of surveyModify
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyModify($name, $userID, $conn) {
    echo '
    <div class="modify-surveys">
    <h1>Hello <span>' . $name . '</span> this is the manage survey section</h1>

    <h1> Created Surveys: </h1>
    <div class="created-surveys-list">';

    // Select from survey table where userID is equal
    $select = "SELECT * FROM survey WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editSurveyID']);

    // If no surveys were found
    if (mysqli_num_rows($result) == 0) {
        echo '<h1>No surveys were found</h1>';
    }

    // If there are surveys
    else if (mysqli_num_rows($result) > 0) {

        // While row in table exists via result
        while ($row = mysqli_fetch_assoc($result)) { 
            $surveySubmissionCount=0;
            // Lists surveys where where userID is equal
            echo '<div class="survey-item">

                <p> <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '</p>';

            // Researcher display for surveys: if user type is equal to researcher
          //   if(userType() === 'researcher') {   
           //    if (isset($_SESSION['researcher_name'])) {

                echo '
                    <div class="edit-delete-buttons"> <!-- edit and delete buttons div start  -->
            
                    <form method="post" class="edit-method" action="surveyEdit.php">
                        <input type="hidden" name="editSurveyID" value="' . $row['surveyID'] . '">
                        <button type="submit" name="editSurvey">Edit</button>
                    </form>

                    <!-- deleteSurvey button -->
                        <form method="post" action="" class="delete-method" onsubmit="return confirm(\'Are you sure you want to delete this survey?\');">
                            <input type="hidden" name="survey_id" value="' . $row['surveyID'] . '">
                            <button name="deleteSurvey" value="submit" type="submit">Delete</button>
                        </form>
                    </div> <!-- edit and delete buttons div end  -->';

                        // SQL query to count the distinct rows
                        $countQuery = "SELECT COUNT(DISTINCT `userID`) AS surveySubmissionCount FROM `user_survey` WHERE `surveyID` = '{$row['surveyID']}';";
                        $countResult = mysqli_query($conn, $countQuery);

                        // Check if the query was successful and that there are rows
                        if ($result && $count = mysqli_fetch_assoc($countResult)) {

                            // Access the count value directly
                            $surveySubmissionCount = $count['surveySubmissionCount'];
                            
                            // Free the result set
                            mysqli_free_result($countResult);
                        } 
                        
                        // If the query was not successful, or there was not rows:
                        else {
                            $surveySubmissionCount = 0;
                        }

                    echo'
                    <p> <b>Survey submissions:</b> '.$surveySubmissionCount.'</p>

                    <div class="view-submissions-button"> <!-- view-submissions-buttons div start  -->
                        <form method="post" class="submissions-method" action="surveyView.php">
                            <input type="hidden" name="viewSurveyID" value="' . $row['surveyID'] . '">
                            <button type="submit" name="viewSurvey">View Submissions</button>
                        </form>
                    </div>';

            //   }
           // }
                    // Researcher name display end
            echo '        
            </div><br> <!-- survey-item end -->';
        } // While end
    } // Else-if end
    
    /* Create surveys can only be done by the researchers, as it is being 
    implemented here: Researcher display start */
  //  if(userType() === 'researcher') {
   //     if (isset($_SESSION['researcher_name'])) {
            echo '
                <!-- Create survey button -->
                <button onclick="surveyCreate()" class="create-btn"> <b>Create New Survey</b>  </button>
                </div> <!-- created-surveys-list end -->';
      //  }
     //} // Researcher display end


    echo '
    </div>
    <div class="modify-survey">
    <h1>Completed Surveys:</h1>
    <div class="created-surveys-list">';

    // Select distinct surveyIDs from user_survey where $userID is equal to userID column
    $surveyIDQuery = "SELECT DISTINCT surveyID FROM `user_survey` WHERE `userID` = '$userID';";
    
    $completedSurveyIDs = array();

    $result = mysqli_query($conn, $surveyIDQuery);
  
    // Check for errors
    if (!$result) {
        echo "Error in query: " . mysqli_error($conn);
    } else {
        // Obtaining Completed Survey IDs
        while ($row = mysqli_fetch_assoc($result)) {
            $completedSurveyIDs[] = $row['surveyID'];
        }

        // Check if there are completedSurveyIDs before executing the query
        if (!empty($completedSurveyIDs)) {
            // Create a New Query for Surveys where $userID is equal to userID column with the commas removed from the completedSurveysIDs array.
            $newSelect = "SELECT * FROM survey WHERE surveyID IN (" . implode(',', $completedSurveyIDs) . ");";
            $newResult = mysqli_query($conn, $newSelect);

            // Check for errors
            if (!$newResult) {
                echo "Error in query: " . mysqli_error($conn);
            } 
            
            else {
                $uniqueSurveyIDs = array();

                // Display Only Unique Surveys
                while ($newRow = mysqli_fetch_assoc($newResult)) {
                    $surveyID = $newRow['surveyID'];

                    // Display only if the surveyID is not already displayed
                    if (!in_array($surveyID, $uniqueSurveyIDs)) {
                        echo '<div class="survey-item">
                            <p> <b>Name:</b> ' . $newRow['name'] . '<br>  <b>Description:</b> ' . $newRow['description'] . '</p>
                            <div class="edit-delete-answers-buttons">
                                <form method="post" class="edit-answers-method" action="surveyAnswerEdit.php">
                                    <input type="hidden" name="editSurveyID" value="' . $surveyID . '">
                                    <button type="submit" name="editAnswers">Edit answers</button>
                                </form>
                                <form method="post" action="" class="delete-answers-method" onsubmit="return confirm(\'Are you sure you want to delete your answers to this survey?\');">
                                    <input type="hidden" name="survey_id" value="' . $surveyID . '">
                                    <button name="deleteAnswers" value="submit" type="submit">Delete answers</button>
                                </form>
                            </div>
                        </div><br>';

                        // Add surveyID to the uniqueSurveyIDs array
                        $uniqueSurveyIDs[] = $surveyID;
                    }
                }
            }
        } else {
            // Display message if there are no completedSurveyIDs
            echo '<h1>No completed surveys found</h1>';
        }
    }
    
    echo '
    </div>
    </div> <!-- modify-surveys end -->';

    // If deleteSurvey is posted
    if (isset($_POST['deleteSurvey'])) {

        // Creates surveyID variable from the posted data
        $surveyID = mysqli_real_escape_string($conn, $_POST['survey_id']);

        // Delete from survey table where surveyID is equal
        $deleteQuery = "DELETE FROM survey WHERE surveyID = '$surveyID';";
       
        // If query was successful
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Survey deleted successfully!";
        }

        // If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } // If end

    // If deleteSurvey is posted
    if (isset($_POST['deleteAnswers'])) {

        // Creates surveyID variable from the posted data
        $surveyID = mysqli_real_escape_string($conn, $_POST['survey_id']);

        // Retrieve all responseIDs from user_survey
        $selectResponseID = "SELECT responseID FROM user_survey WHERE surveyID = '$surveyID' AND userID = '$userID';";
        $resultResponseID = mysqli_query($conn, $selectResponseID);

        $responseIDs = array();

        while ($rowResponseID = mysqli_fetch_assoc($resultResponseID)) {
            $responseIDs[] = $rowResponseID['responseID'];
        }

        // Delete from user_survey table where surveyID is equal and userID is equal
        $deleteQuery = "DELETE FROM user_survey WHERE surveyID = '$surveyID' AND userID = '$userID';";

        // If query was successful
        if (mysqli_query($conn, $deleteQuery)) {
            echo "User survey entries deleted successfully!";

            // Check if there are any responseIDs to delete
            if (!empty($responseIDs)) {
                // Construct IN clause for responseIDs
                $responseIDsString = implode(',', $responseIDs);

                // Delete from surveyresponse using the retrieved responseID(s)
                $deleteAnswerQuery = "DELETE FROM surveyresponse WHERE responseID IN ($responseIDsString);";
                if (mysqli_query($conn, $deleteAnswerQuery)) {
                    echo "Responses deleted successfully!";
                } 
                
                else {
                    echo "Error deleting responses: " . mysqli_error($conn);
                }
            }
        } 
        
        else {
            echo "Error deleting survey: " . mysqli_error($conn);
        }
    } // If end

}

/**
 * Summary of surveyAnswerEdit
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyAnswerEdit($name, $userID, $conn) {

    // Initialize variables with default values
    $surveyName = '';
    $surveyDescription = '';
    $SurveyID = '';
    $questionCounter = 0; // Initialize questionCounter

    // Checks if surveyID to edit is posted
    if (isset($_POST['editSurveyID'])) {

        // Access and store the surveyID in a variable
        $SurveyID = $_POST['editSurveyID'];

        // Store the data for the name and description from the survey table via the $surveyID
        $selectedSurveyData = "SELECT `name`, `description` FROM `survey` WHERE `surveyID` = '$SurveyID';";
        $resultSurveyData = mysqli_query($conn, $selectedSurveyData);

        $selectedSurveyQuestions = "SELECT * FROM `surveyquestion` WHERE `surveyID` = '$SurveyID';";
        $resultSurveyQuestions = mysqli_query($conn, $selectedSurveyQuestions);

        // Retrieve all responseIDs from user_survey
        $selectResponseID = "SELECT responseID FROM user_survey WHERE surveyID = '$SurveyID' AND userID = '$userID';";
        $resultResponseID = mysqli_query($conn, $selectResponseID);

        $responseIDs = array();

        while ($rowResponseID = mysqli_fetch_assoc($resultResponseID)) {
            $responseIDs[] = $rowResponseID['responseID'];
        }

        // If there is a result for the name & description
        if ($resultSurveyData && mysqli_num_rows($resultSurveyData) > 0) {

            // Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSurveyData);

            // Info in the row to variables
            $surveyName = $row['name'];
            $surveyDescription = $row['description'];
        }

        // If there is a result for the survey questions
        if ($resultSurveyQuestions && mysqli_num_rows($resultSurveyQuestions) > 0) {

            // Gets the number of rows & used as a counter to track the number of questions
            $questionCounter = mysqli_num_rows($resultSurveyQuestions);
        }
    } // Outer if end
    else {
        echo "editSurveyID is not set after form submission!";
    }
    echo '
    <div class="complete-surveys">
        <h1>Hello <span>' . $name . '</span>, this is the edit survey answers section</h1>';

    // Display survey questions and answer input-forms here

    echo '
        <form action="" method="post">
    
        <!--$edittedSurveyID for editing and $questionCounter for editing the answers-->
        <input type="hidden" name="editSurveyID" value="' . $SurveyID . '">
        <input type="hidden" name="questionCounter" value="' . ($questionCounter + 1) . '">

            <!-- $surveyName data as a placeholder for the name form -->
            <label for="surveyName"><b>Survey Name:</b><br>' . $surveyName . '</label>
            <br><br>
            
            <!-- $surveyDescription data as a placeholder for the description form -->
            <label for="surveyDescription"><b>Survey Description:</b><br>' . $surveyDescription . '</label>
            <br><br>';

    // Display question input-forms based on the number of questions
    for ($i = 1; $i <= $questionCounter; $i++) {
        // Fetch the question data for the current iteration
        $questionData = mysqli_fetch_assoc($resultSurveyQuestions);

        echo '
        <label for="question"><b>Question ' . $i . ': </b>' . $questionData['question'] . '</label>
        <br>';

    // Fetch responses associated with the current question for the user
    $selectResponses = "SELECT * FROM `surveyresponse` 
                        JOIN `user_survey` ON `surveyresponse`.`responseID` = `user_survey`.`responseID`
                        WHERE `surveyresponse`.`questionID` = '" . $questionData['questionID'] . "'
                            AND `user_survey`.`userID` = '$userID';";
    $resultResponses = mysqli_query($conn, $selectResponses);

    while ($responseData = mysqli_fetch_assoc($resultResponses)) {
        echo '
        <input type="text" name="response[' . $responseData['responseID'] . ']" class="form-input" value="' . $responseData['response'] . '" required>
        <br>';
    }


        echo '<br>';
    }

    echo '
        <!-- Submit form that posts updateSurvey -->
        <input type="submit" name="updateSurvey" value="Submit" class="form-btn">

        <!-- Cancel button links to surveyModify.php -->
        <input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="Cancel" class="cancel-link">
        <br>
    </form>
    </div> <!-- edit-surveys end -->';

    // If updateSurvey is posted
    if (isset($_POST['updateSurvey'])) {
        foreach ($_POST['response'] as $responseID => $responseText) {
            // Perform SQL update for each response
            $updateResponseQuery = "UPDATE `surveyresponse` SET `response` = '$responseText' WHERE `responseID` = '$responseID';";

            if (mysqli_query($conn, $updateResponseQuery)) {
                echo "Response updated successfully <br>";
            } else {
                echo "Error updating response: " . mysqli_error($conn) . "<br>";
            }
        }

        // You may also want to redirect the user after updating responses
        // header("Location: surveyAnswerEdit.php");
    }
}

/**
 * Summary of surveyEdit
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyEdit($name, $userID, $conn) {
    // Initialize variables with default values
    $surveyName = '';
    $surveyDescription = '';
    $edittedSurveyID = '';

    // Checks if surveyID to edit is posted
    if (isset($_POST['editSurveyID'])) {

        // Access and store the surveyID in a variable
        $edittedSurveyID = $_POST['editSurveyID'];
        
        // Store the data for the name and description from the survey table via the $surveyID
        $selectedSurveyData = "SELECT `name`, `description` FROM `survey` WHERE `surveyID` = '$edittedSurveyID';";
        $resultSurveyData = mysqli_query($conn, $selectedSurveyData);
        $selectedSurveyQuestions = "SELECT *  FROM `surveyquestion` WHERE `surveyID` = '$edittedSurveyID';";
        $resultSurveyQuestions = mysqli_query($conn, $selectedSurveyQuestions);

        // If there is a result for the name & description
        if ($resultSurveyData && mysqli_num_rows($resultSurveyData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSurveyData);

            //Info in the row to variables
            $surveyName = $row['name'];
            $surveyDescription = $row['description'];
        }

        // If there is a result for the survey questions
        if ($resultSurveyQuestions && mysqli_num_rows($resultSurveyQuestions) > 0) {
            // Gets the number of rows & used as counter to track the number of questions
            $questionCounter = mysqli_num_rows($resultSurveyQuestions);
        }
    } // Outer if end

    echo '
    <div class="edit-surveys">
    <h1>Hello <span>' . $name . '</span> this is the edit survey section</h1>';

    echo '
    <form action="" method="post">

        <!--$edittedSurveyID for editing and $questionCounter for editing the questions-->
        <input type="hidden" name="editSurveyID" value="' . $edittedSurveyID . '">
        <input type="hidden" name="questionCounter" value="' . ($questionCounter + 1) . '">

        <!--$surveyName data as a placeholder for the name form-->
        <label for="surveyName"><b>Survey Name:</b></label>
        <br>
        <input type="text" name="surveyName" value="' . $surveyName . '" class="form-input" required>
        <br><br>

        <!--$surveyDescription data as a placeholder for the description form-->
        <label for="surveyDescription"><b>Survey Description:</b></label>
        <br>
        <textarea name="surveyDescription" class="form-textarea" required>' . $surveyDescription . '</textarea>
        <br><br>';

// Display question input-forms based on the number of questions
for ($i = 1; $i <= $questionCounter; $i++) {
    // Fetch the question data for the current iteration
    $questionData = mysqli_fetch_assoc($resultSurveyQuestions);

    echo '
    <div class="question-container">
        <div class="question-input-container">
            <label for="question"><b>Question ' . $i . ':</b></label><br>
            <input type="text" name="question[]" class="form-input" value="' . $questionData['question'] . '" required>
        </div>
        <br>
        <!-- Delete button for each question -->

    </div>';
}

//<form method="post" action="" class="delete-question-method" onsubmit="return confirm(\'Are you sure you want to delete this question?\');">
//    <input type="hidden" name="deleteQuestionID" value="' . $questionData['questionID'] . '">
//    <button name="deleteQuestion" value="submit" type="submit">Delete</button>
//</form>
    echo '
        <!-- Container for dynamically added questions -->
        <div id="questionContainer"></div>

        <!-- Add question" button to dynamically add more question input-forms -->
        <input type="button" id="addQuestion" value="Add Question" class="form-btn" onclick="addQuestionHere();">

        <!--Submit form that posts updateSurvey-->
        <input type="submit" name="updateSurvey" value="Submit" class="form-btn">

        <!--Cancel button links to surveyModify.php-->
        <input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="Cancel" class="cancel-link">
        <br>
    </form>
    </div> <!-- edit-surveys end -->';

    // If updateSurvey is posted
    if (isset($_POST['updateSurvey'])) {

        // Create name and description variables from the posted data
        $surveyName = mysqli_real_escape_string($conn, $_POST['surveyName']);
        $surveyDescription = mysqli_real_escape_string($conn, $_POST['surveyDescription']);

        // Update the survey table row name and description column where the $surveyID is equal
        $editQuery = "UPDATE `survey` SET `name` = '$surveyName', `description` = '$surveyDescription' WHERE `survey`.`surveyID` = '$edittedSurveyID';";

        // If query was successful
        if (mysqli_query($conn, $editQuery)) {
            echo "Name & Description update successful <br>";
            //header('location: surveyModify.php');
            //exit(); // Important to prevent further execution after the redirect
        }

        // If query was not successful
        else {
            echo "Error: " . mysqli_error($conn) ."<br>";
        }

        // Reset the result set pointer to the beginning
        mysqli_data_seek($resultSurveyQuestions, 0);

        // Update questions in the surveyquestion table
        foreach ($_POST['question'] as $questionIndex => $questionText) {

            // Fetch the existing question data for the current iteration
            $existingQuestionData = mysqli_fetch_assoc($resultSurveyQuestions);

            //If there is an existing question
            if ($existingQuestionData !== null) {

                // Update the existing row with the new question text
                $questionID = $existingQuestionData['questionID'];
                $updateQuestionQuery = "UPDATE `surveyquestion` SET `question` = '$questionText' WHERE `questionID` = '$questionID';";

                // If query was successful
                if (mysqli_query($conn, $updateQuestionQuery)) {
                    echo "Question updated successfully <br>";
                }

                // If query was not successful
                else {
                    echo "Error updating question: " . mysqli_error($conn) . "<br>";
                }
            }
            //If there is no existing question, insert a new question
            else {
                $insertQuestionQuery = "INSERT INTO `surveyquestion` (`questionID`, `surveyID`, `question`, `questionNumber`) VALUES (NULL, '$edittedSurveyID', '$questionText', '" . ($questionCounter + 1) . "');";

                // If query was successful
                if (mysqli_query($conn, $insertQuestionQuery)) {
                    echo "Question inserted successfully <br>";
                }
                
                // If query was not successful
                else {
                    echo "Error inserting question: " . mysqli_error($conn) . "<br>";
                }
            }
        }
    } // Outer if end

    // If deleteQuestion is posted
    if (isset($_POST['deleteQuestion'])) {
        // Creates questionID variable from the posted data
        $questionID = mysqli_real_escape_string($conn, $_POST['deleteQuestionID']);

        // Delete from user_survey table where questionID and userID match
        $deleteUserSurveyQuery = "DELETE FROM user_survey WHERE questionID = '$questionID' AND userID = '$userID';";

        // Delete from surveyresponse table where questionID matches
        $deleteSurveyResponseQuery = "DELETE FROM surveyresponse WHERE questionID = '$questionID';";

        // Delete from surveyquestion table where questionID matches
        $deleteSurveyQuestionQuery = "DELETE FROM surveyquestion WHERE questionID = '$questionID';";

        // Execute the first query
        if (mysqli_query($conn, $deleteUserSurveyQuery)) {
            echo "Deleted entries successfully from user_survey <br>";

            // Execute the second query
            if (mysqli_query($conn, $deleteSurveyResponseQuery)) {
                echo "Deleted entries successfully from surveyresponse <br>";
                
                // Execute the third query
                if (mysqli_query($conn, $deleteSurveyQuestionQuery)) {
                    echo "Deleted entries successfully from surveyquestion <br>";
                }
                
                else {
                    echo "Error deleting surveyquestion entries: " . mysqli_error($conn) . "<br>";
                }
            }
            
            else {
                echo "Error deleting surveyresponse entries: " . mysqli_error($conn) . "<br>";
            }
        }
        
        else {
            echo "Error deleting user_survey entries: " . mysqli_error($conn) . "<br>";
        }
    }
}

/**
 * Summary of surveyView
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function surveyView($name, $userID, $conn) {
    // Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        }
    }

    // Initialize variables with default values
    $surveyName = '';
    $surveyDescription = '';
    $submittedSurveyID = '';

    // Checks if surveyID to view is posted
    if (isset($_POST['viewSurveyID'])) {

        // Access and store the surveyID in a variable
        $submittedSurveyID = $_POST['viewSurveyID'];

        // Store the data for the name and description from the survey table via the $surveyID
        $selectedSurveyData = "SELECT `name`, `description` FROM `survey` WHERE `surveyID` = '$submittedSurveyID';";
        $resultSurveyData = mysqli_query($conn, $selectedSurveyData);
        $selectedSurveyQuestions = "SELECT * FROM `surveyquestion` WHERE `surveyID` = '$submittedSurveyID';";
        $resultSurveyQuestions = mysqli_query($conn, $selectedSurveyQuestions);

        // If there is a result for the name & description
        if ($resultSurveyData && mysqli_num_rows($resultSurveyData) > 0) {

            // Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSurveyData);

            // Info in the row to variables
            $surveyName = $row['name'];
            $surveyDescription = $row['description'];
        }

        // Display survey name and description
        echo '
        <div class="view-submissions">
            <h1>Hello <span>' . $name . '</span>, this is the view survey section</h1>

            <b>Survey Name: </b><br>' . $surveyName . ' <br><br>
            <b>Survey Description: </b><br>' . $surveyDescription . '<br><br>';

            // Modify the query to join user_survey, surveyresponse, and surveyquestion tables
            $selectedUserSurveys = "SELECT DISTINCT `user`.`userID`, `user`.`firstname`, `user`.`lastname`, `user`.`email`
                                    FROM `user_survey`
                                    JOIN `user` ON `user_survey`.`userID` = `user`.`userID`
                                    WHERE `user_survey`.`surveyID` = '$submittedSurveyID';";
            $resultUserSurveys = mysqli_query($conn, $selectedUserSurveys);
            echo '
            <div class="survey-list">';
                // Loop through each user and display their responses
                while ($user = mysqli_fetch_assoc($resultUserSurveys)) {
                    $currentUserID = $user['userID'];

                    $selectedUserSurveyResponses = "SELECT `surveyresponse`.`response`, `surveyresponse`.`questionID`
                                                FROM `user_survey` 
                                                JOIN `surveyresponse` ON `user_survey`.`responseID` = `surveyresponse`.`responseID` 
                                                WHERE `user_survey`.`userID` = '$currentUserID' 
                                                    AND `user_survey`.`surveyID` = '$submittedSurveyID';";

                    $resultUserSurveyResponses = mysqli_query($conn, $selectedUserSurveyResponses);

                    // Display responses for the current user
                    echo '
                    <div class="survey-item">            
                        <b>User: </b>' . $user['firstname'] . ' ' . $user['lastname'] . '<br><b>Email: </b>' . $user['email'] . '<br><br>';
                        while ($response = mysqli_fetch_assoc($resultUserSurveyResponses)) {
                            $questionID = $response['questionID'];

                            // Fetch the corresponding question from surveyquestion table
                            $selectedQuestion = "SELECT `question` FROM `surveyquestion` WHERE `questionID` = '$questionID';";
                            $resultQuestion = mysqli_query($conn, $selectedQuestion);
                            $questionRow = mysqli_fetch_assoc($resultQuestion);
                            $question = $questionRow['question'];

                            // Display question and response
                            echo '<b>Question:</b> ' . $question . '<br>';
                            echo '<b>Response:</b> ' . $response['response'] . '<br><br>';
                        }
                echo '</div><br>'; //survey-item end
            }
            echo '</div> <!-- survey-list end -->
            <input type="button" onClick="window.location.href=\'surveyModify.php\'" name="cancel" value="Return" class="return-method"></input> <!-- Return button links to surveyModify.php-->
            </div><!-- view-submissions end -->';
    } // Outer if end
}


/**
 * Summary of opportunitySearch
 * @param mixed $name
 * @param mixed $conn
 * @return void
 */
function opportunitySearch($name, $userID, $conn) {
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
            <p style="display: block;"><b>Search By:</b></p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="opportunity-search-name-box"><label for="search"><b>Name:</b></label><input type="text" name="searchName" placeholder="Opportunity name"></div>
            <div class="opportunity-search-tag-box"><label for="tag"><b>Tags:</b></label><input type="text" name="searchTag" placeholder="Tag name"></div>
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
                echo '
                <div class="opportunity-item">
                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br>';

                // Join button to be displayed within the search section
                echo '<br>
                                
                <div class="join-button"> <!-- join button div start -->';

                // Check if a row exists in user_opportunity for the specified userID and opportunityID
                $checkUserOpportunity = "SELECT * FROM user_opportunity WHERE userID = '$userID' AND opportunityID = '" . $row['opportunityID'] . "'";
                $resultUserOpportunity = mysqli_query($conn, $checkUserOpportunity);

                if (mysqli_num_rows($resultUserOpportunity) == 0) {
                    // If no row exists, display the "Join Opportunity" button
                    echo '<form method="post" class="join-method" action="">
                            <input type="hidden" name="joinOpportunityID" value="' . $row['opportunityID'] . '">
                            <button type="submit" name="joinOpportunity">Join opportunity</button>
                        </form>';
                } else {
                    // If a row exists, display a message
                    echo 'You have already joined this opportunity.';
                }

                echo '</div> <!-- join button div end -->
                </div> <!-- opportunity-item div end -->
                <br>';
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
                echo '
                <div class="opportunity-item">
                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br>';
                echo '
                </div><br>';
            } //While end
        } //Else if end
        unset($_POST['opportunitySearch']);
    } //If end
    echo'
        </div> <!-- search-opportunities-list end -->
    </div> <!-- search-opportunities-box end -->';
    
        // If opportunitySearch is posted
        if (isset($_POST['joinOpportunity'])) {
            // Access the opportunity ID from the posted data
            $joinOpportunityID = mysqli_real_escape_string($conn, $_POST['joinOpportunityID']);
    
            // Insert into user_opportunity table only if not already joined
            $checkUserOpportunity = "SELECT * FROM user_opportunity WHERE userID = '$userID' AND opportunityID = '$joinOpportunityID'";
            $resultUserOpportunity = mysqli_query($conn, $checkUserOpportunity);
    
            if (mysqli_num_rows($resultUserOpportunity) == 0) {
                // Insert into user_opportunity table
                $insertUserOpportunity = "INSERT INTO user_opportunity (userID, opportunityID) VALUES ('$userID', '$joinOpportunityID')";
    
                if (mysqli_query($conn, $insertUserOpportunity)) {
                    // Insertion successful
                    echo "Joined opportunity successfully!";
                } else {
                    // Insertion failed
                    echo "Error joining opportunity: " . mysqli_error($conn);
                }
            } else {
                // Display a message if already joined
                echo "You have already joined this opportunity.";
            }
        }
}

/**
 * Summary of opportunityCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function opportunityCreate($name, $userID, $conn) {

    echo '
    <div class="create-opportunities">
    <h1>Hello <span>' . $name . '</span> this is the create opportunity section</h1>

    <form action="" method="post"> <!-- form for create opportunity info start-->
        <label for="opportunityname"><b>Opportunity name:</b></label><br><!-- opportunityName button -->
        <input type="text" id="opportunity_name" name="opportunity_name" required placeholder="Opportunity name">
        <br><br>

        <label for="opportunitydescription"><b>Opportunity description:</b></label><br><!-- opportunityDescription button -->
        <input type="text" id="opportunity_description" name="opportunity_description" required placeholder="Opportunity description">
        <br><br>

        <label for="opportunitylocation"><b>Opportunity location:</b></label><br><!-- opportunityLocation button -->
        <input type="text" id="opportunity_location" name="opportunity_location" required placeholder="Opportunity location">
        <br><br>

        <label for="opportunitydate"><b>Opportunity date:</b></label><br><!-- opportunityDate button -->
        <input type="datetime-local" id="opportunity_date" name="opportunity_date" required placeholder="Opportunity date">
        <br><br>

        <label for="opportunitycompensation"><b>Opportunity compensation amount: ( Leave at 0 if none )</b></label><br><!-- opportunityCompensation button -->
        <input type="number" id="opportunity_compensation" name="opportunity_compensation" placeholder="0" min="0">
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
        $location = mysqli_real_escape_string($conn, $_POST['opportunity_location']);
        $date = mysqli_real_escape_string($conn, $_POST['opportunity_date']);
        $compensation = mysqli_real_escape_string($conn, $_POST['opportunity_compensation']);
        //$tags = mysqli_real_escape_string($conn, $_POST['opportunity_tags']);

        //Insert into opportunity table with the created variables
        $insert = "INSERT INTO `opportunity` (`opportunityID`, `ownerID`, `name`, `description`, `location`, `date`, `compensation`) VALUES (NULL, '$userID', '$name', '$description', '$location', '$date', '$compensation');";
        
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
function opportunityModify($name, $userID, $conn) {
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

                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br>';
                    // Display for researcher
                if(userType() === 'researcher') {     
                    if (isset($_SESSION['researcher_name'])) {
                    echo '    
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

                </div> <!-- edit and delete buttons div start  -->';
                }
            } 
            
            // SQL query to count the distinct rows
            $countQuery = "SELECT COUNT(DISTINCT `userID`) AS opportunitySubmissionCount FROM `user_opportunity` WHERE `opportunityID` = '{$row['opportunityID']}';";
            $countResult = mysqli_query($conn, $countQuery);

            // Check if the query was successful and that there are rows
            if ($result && $count = mysqli_fetch_assoc($countResult)) {

                // Access the count value directly
                $opportunitySubmissionCount = $count['opportunitySubmissionCount'];
                
                // Free the result set
                mysqli_free_result($countResult);
            } 

            // If the query was not successful, or there was not rows:
            else {
                $opportunitySubmissionCount = 0;
            }

            echo'
            <p> <b>Opportunity members:</b> '.$opportunitySubmissionCount.'</p>

            <div class="view-submissions-button"> <!-- view-submissions-buttons div start  -->
                <form method="post" class="submissions-method" action="opportunityView.php">
                    <input type="hidden" name="viewOpportunityID" value="' . $row['opportunityID'] . '">
                    <button type="submit" name="viewOpportunity">View joined members</button>
                </form>
            </div>';
             echo '   
            </div><br> <!-- opportunity-item end -->';
        } //While end
    } //Else if end

    /* Create opportunities can only be done by the researchers, as it is being 
    implemented here: Researcher display start */
    if(userType() === 'researcher') {
        if (isset($_SESSION['researcher_name'])) {
        echo '
        <!-- Create opportunity button -->
        <button onclick="opportunityCreate()" class="create-btn"> <b>Create New Opportunity</b>  </button>
        </div> <!-- created-opportunities-list end -->';
        }
     } // Researcher display end

    echo '
    <h1>Joined Opportunities:</h1>
    <div class="opportunity-list">';
    
        // Select opportunities that the user has joined
        $selectJoinedOpportunities = "SELECT s.* FROM opportunity s
                                INNER JOIN user_opportunity us ON s.opportunityID = us.opportunityID
                                WHERE us.userID = '$userID'";
        $resultJoinedOpportunities = mysqli_query($conn, $selectJoinedOpportunities);

        // If there are no opportunities
        if (mysqli_num_rows($resultJoinedOpportunities) == 0) {
            echo 'You have not joined any opportunities yet.';
        }

        // If there are opportunities
        else if (mysqli_num_rows($resultJoinedOpportunities) > 0) {

            // While row in table exists via result
            while ($row = mysqli_fetch_assoc($resultJoinedOpportunities)) {

                // Lists all opportunities
                echo '
                <div class="opportunity-item">
                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br><br>';

                    echo '<form method="post" class="leave-method" action="">
                            <input type="hidden" name="leaveOpportunityID" value="' . $row['opportunityID'] . '">
                            <button type="submit" name="leaveOpportunity">Leave opportunity</button>
                        </form>';

                echo '</div> <!-- opportunity-item div end -->
                <br>';
            } // While end
        } // Else if end
        
        echo '
    </div> <!-- opportunity-list end -->
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

    // If leaveOpportunity is posted
    if (isset($_POST['leaveOpportunity'])) {
        // Access the leaveOpportunityID and sanitize the data
        $leaveOpportunityID = mysqli_real_escape_string($conn, $_POST['leaveOpportunityID']);

        // Delete from user_opportunity where userID equals $userID and opportunityID equals $leaveOpportunityID
        $deleteUserOpportunityQuery = "DELETE FROM user_opportunity WHERE userID = '$userID' AND opportunityID = '$leaveOpportunityID'";

        // If the deletion query was successful
        if (mysqli_query($conn, $deleteUserOpportunityQuery)) {
            echo "Left opportunity successfully!";
        } else {
            // If the deletion query failed
            echo "Error leaving opportunity: " . mysqli_error($conn);
        }
    }
}

/**
 * Summary of opportunityEdit
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function opportunityEdit($name, $userID, $conn) { 
    
    //Initialize variables with default values
    $opportunityName = '';
    $opportunityDescription = '';
    $opportunityLocation = '';
    $opportunityDate = '';
    $opportunityCompensation = '';
    $edittedOpportunityID = '';

    //Checks if opportunityID to edit is posted
    if (isset($_POST['editOpportunityID'])) {

        //Access access and store the opportunityID in a variable
        $edittedOpportunityID = $_POST['editOpportunityID'];

        //Store the data for the name and description from the opportunity table via the $opportunityID
        $selectedOpportunityData = "SELECT `name`, `description`, `location`, `date`, `compensation` FROM `opportunity` WHERE `opportunityID` ='$edittedOpportunityID';";
        $resultOpportunityData = mysqli_query($conn, $selectedOpportunityData);

        //If there is a result
        if ($resultOpportunityData && mysqli_num_rows($resultOpportunityData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultOpportunityData);

            //Info in the row to variables
            $opportunityName = $row['name'];
            $opportunityDescription = $row['description'];
            $opportunityLocation = $row['location'];
            $opportunityDate = $row['date'];
            $opportunityCompensation = $row['compensation'];
        } //Inner if end
    } //Outer if end
    
    echo '
    <div class="edit-opportunities">
    <h1>Hello <span>' . $name. '</span> this is the edit opportunity section</h1>';

    //Five forms, one for each part of the opportunity table: ( `name`, `description`, `location`, `date`, `compensation`)
    echo '
    <form action="" method="post">
        <input type="hidden" name="editOpportunityID" value="' . $edittedOpportunityID . '">

        <!--$opportunityName data as a placeholder for the name form-->
        <label for="opportunityName"><b>Opportunity Name:</b></label>
        <br>
        <input type="text" name="opportunityName" value="' . $opportunityName . '" class="form-input" required>
        <br><br>

        <!--$opportunityDescription data as a placeholder for the description form-->
        <label for="opportunityDescription"><b>Opportunity Description:</b></label>
        <br>
        <textarea name="opportunityDescription" class="form-textarea" required>' . $opportunityDescription . '</textarea>
        <br><br>

        <!--$opportunityLocation data as a placeholder for the location form-->
        <label for="opportunityLocation"><b>Opportunity Location:</b></label>
        <br>
        <input type="text" name="opportunityLocation" value="' . $opportunityLocation . '" class="form-input" required>
        <br><br>

        <!--$opportunityDate data as a placeholder for the date form-->
        <label for="opportunityDate"><b>Opportunity Date:</b></label>
        <br>
        <input type="datetime-local" name="opportunityDate" value="' . date('Y-m-d\TH:i', strtotime(str_replace(' ', 'T', $opportunityDate))) . '" class="form-input" required>
        <br><br>

        <!--$opportunityCompensation data as a placeholder for the compensation form-->
        <label for="opportunityCompensation"><b>Opportunity Compensation:</b></label>
        <br>
        <input type="text" name="opportunityCompensation" value="' . $opportunityCompensation . '" class="form-input">
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
        $opportunityLocation = mysqli_real_escape_string($conn, $_POST['opportunityLocation']);
        $opportunityDate = mysqli_real_escape_string($conn, $_POST['opportunityDate']);
        $opportunityCompensation = mysqli_real_escape_string($conn, $_POST['opportunityCompensation']);

        //Update the opportunity table row name and description column where the $opportunityID is equal
        $editQuery = "UPDATE `opportunity` SET `name` = '$opportunityName', `description` = '$opportunityDescription', `location`='$opportunityLocation', `date`='$opportunityDate', `compensation`='$opportunityCompensation' WHERE `opportunity`.`opportunityID` = '$edittedOpportunityID';";
        
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
    } //Outer if end

}
/**
 * Summary of opportunityView
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function opportunityView($name, $userID, $conn) {
    // Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        }
    }

    // Initialize variables with default values
    $opportunityName = '';
    $opportunityDescription = '';
    $opportunityLocation = '';
    $opportunityDate = '';
    $opportunityCompensation = '';
    $submittedOpportunityID = '';

    // Checks if opportunityID to view is posted
    if (isset($_POST['viewOpportunityID'])) {

        // Access and store the opportunityID in a variable
        $submittedOpportunityID = $_POST['viewOpportunityID'];

        // Store the data for the name and description from the support group table via the $opportunityID
        $selectedOpportunityData = "SELECT * FROM `opportunity` WHERE `opportunityID` = '$submittedOpportunityID';";
        $resultOpportunityData = mysqli_query($conn, $selectedOpportunityData);

        // If there is a result for the name & description
        if ($resultOpportunityData && mysqli_num_rows($resultOpportunityData) > 0) {

            // Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultOpportunityData);

            // Info in the row to variables
            $opportunityName = $row['name'];
            $opportunityDescription = $row['description'];
            $opportunityLocation = $row['location'];
            $opportunityDate = $row['date'];
            $opportunityCompensation = $row['compensation'];
        }

        // Display support group name and description
        echo '
        <div class="view-submissions">
            <h1>Hello <span>' . $name . '</span>, this is the view support group section</h1>
            <div class="opportunity-list">
                <div class="opportunity-item">
                    <b>Name: </b><br>' . $opportunityName . ' <br><br>
                    <b>Description: </b><br>' . $opportunityDescription . '<br><br>
                    <b>Location: </b><br>' . $opportunityLocation . '<br><br>
                    <b>Date: </b><br>' . date('Y-m-d H:i:s', strtotime($opportunityDate)) . '<br><br>
                    <b>Compensation: </b><br>' . $opportunityCompensation . '<br><br>';

        // Select user details from user_opportunity and user tables
        $selectUserOpportunity = "SELECT u.firstName, u.lastName, u.email
                                   FROM user_opportunity us
                                   INNER JOIN user u ON us.userID = u.userID
                                   WHERE us.opportunityID = '$submittedOpportunityID'";
        $resultUserOpportunity = mysqli_query($conn, $selectUserOpportunity);

        // If there are user details
        if ($resultUserOpportunity && mysqli_num_rows($resultUserOpportunity) > 0) {
            echo '<b>Members: </b><br>';

            // Loop through each user and display their first name and last name
            while ($userRow = mysqli_fetch_assoc($resultUserOpportunity)) {
                echo '<b>Name: </b>' . $userRow['firstName'] . ' ' . $userRow['lastName'] . '<b> Email: </b>' . $userRow['email'] . '<br>';
            }
        }

        echo '
                </div><!-- opportunity-item end -->
            </div><!-- opportunity-list end -->

            <input type="button" onClick="window.location.href=\'opportunityModify.php\'" name="cancel" value="Return" class="return-method"></input> <!-- Return button links to opportunityModify.php-->
        </div><!-- view-submissions end -->';
    } // Outer if end
}

/**
 * Summary of supportGroupSearch
 * @param mixed $name
 * @param mixed $conn
 * @return void
 */
function supportGroupSearch($name, $userID, $conn) {
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
            <p style="display: block;"><b>Search By:</b></p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="supportGroup-search-name-box"><label for="search"><b>Name:</b></label><input type="text" name="searchName" placeholder="Support group name"></div>
            <div class="supportGroup-search-tag-box"><label for="tag"><b>Tags:</b></label><input type="text" name="searchTag" placeholder="Tag name"></div>
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
                
                // Join button to be displayed within the search section
                echo '<br><br>

                <div class="join-button"> <!-- join button div start -->';

                // Check if a row exists in user_supportGroup for the specified userID and supportGroupID
                $checkUserSupportGroup = "SELECT * FROM user_supportGroup WHERE userID = '$userID' AND supportGroupID = '" . $row['supportGroupID'] . "'";
                $resultUserSupportGroup = mysqli_query($conn, $checkUserSupportGroup);

                if (mysqli_num_rows($resultUserSupportGroup) == 0) {
                    // If no row exists, display the "Join support group" button
                    echo '<form method="post" class="join-method" action="">
                            <input type="hidden" name="joinSupportGroupID" value="' . $row['supportGroupID'] . '">
                            <button type="submit" name="joinSupportGroup">Join Support Group</button>
                        </form>';
                } else {
                    // If a row exists, display a message
                    echo 'You have already joined this support group.';
                }

                echo '</div> <!-- join button div end -->
                </div> <!-- supportGroup-item div end -->
                <br>';
            } //While end
        } //Else if end

    echo'
        </div> <!-- supportGroup-list end -->
        <div class="search-supportGroup-list" style="display: none;">';

    //If supportGroupSearch is posted
    if (isset($_POST['supportGroupSearch'])) {
        echo '<script>hideSupportGroup();</script>';

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
                
                // Join button to be displayed within the search section
                echo '<br><br>

                <div class="join-button"> <!-- join button div start -->';

                // Check if a row exists in user_supportGroup for the specified userID and supportGroupID
                $checkUserSupportGroup = "SELECT * FROM user_supportGroup WHERE userID = '$userID' AND supportGroupID = '" . $row['supportGroupID'] . "'";
                $resultUserSupportGroup = mysqli_query($conn, $checkUserSupportGroup);

                if (mysqli_num_rows($resultUserSupportGroup) == 0) {
                    // If no row exists, display the "Join support group" button
                    echo '<form method="post" class="join-method" action="">
                            <input type="hidden" name="joinSupportGroupID" value="' . $row['supportGroupID'] . '">
                            <button type="submit" name="joinSupportGroup">Join Support Group</button>
                        </form>';
                } else {
                    // If a row exists, display a message
                    echo 'You have already joined this support group.';
                }

                echo '</div> <!-- join button div end -->
                </div> <!-- supportGroup-item div end -->
                <br>';
                
            } //While end
        } //Else if end
        unset($_POST['supportGroupSearch']);
    } //If end
    echo'
        </div> <!-- search-supportGroups-list end -->
    </div> <!-- search-supportGroups-box end -->';

    // If joinSupportGroup is posted
    if (isset($_POST['joinSupportGroup'])) {
        // Access the supportGroupID from the posted data
        $joinSupportGroupID = mysqli_real_escape_string($conn, $_POST['joinSupportGroupID']);

        // Insert into user_supportGroup table only if not already joined
        $checkUserSupportGroup = "SELECT * FROM user_supportGroup WHERE userID = '$userID' AND supportGroupID = '$joinSupportGroupID'";
        $resultUserSupportGroup = mysqli_query($conn, $checkUserSupportGroup);

        if (mysqli_num_rows($resultUserSupportGroup) == 0) {
            // Insert into user_supportGroup table
            $insertUserSupportGroup = "INSERT INTO user_supportGroup (userID, supportGroupID) VALUES ('$userID', '$joinSupportGroupID')";

            if (mysqli_query($conn, $insertUserSupportGroup)) {
                // Insertion successful
                echo "Joined support group successfully!";
            } else {
                // Insertion failed
                echo "Error joining support group: " . mysqli_error($conn);
            }
        } else {
            // Display a message if already joined
            echo "You have already joined this support group.";
        }
    }
}

/**
 * Summary of supportGroupCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupCreate($name, $userID, $conn) {
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
function supportGroupModify($name, $userID, $conn) {
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
               <p> <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '</p>';
               
               // Display only for researcher -- Testing
            if(userType() === 'researcher') {     
               if (isset($_SESSION['researcher_name'])) {
                    echo '
                    <div class="edit-delete-buttons"> <!-- edit and delete buttons div start  -->
            
                        <form method="post" class="edit-method" action="supportGroupEdit.php">
                            <input type="hidden" name="editSupportGroupID" value="' . $row['supportGroupID'] . '">
                            <button type="submit" name="editSupportGroup">Edit</button>
                        </form>

                        <!-- deleteSupportGroup button -->
                        <form method="post" action="" class="delete-method" onsubmit="return confirm(\'Are you sure you want to delete this support group?\');">
                            <input type="hidden" name="supportGroup_id" value="' . $row['supportGroupID'] . '"> 
                            <button name="deleteSupportGroup" value="submit" type="submit">Delete</button>
                        </form>
                    </div> <!-- edit and delete buttons div end  -->
                    <!-- Display for researcher end -->';
               }
            }

            // SQL query to count the distinct rows
            $countQuery = "SELECT COUNT(DISTINCT `userID`) AS supportGroupSubmissionCount FROM `user_supportGroup` WHERE `supportGroupID` = '{$row['supportGroupID']}';";
            $countResult = mysqli_query($conn, $countQuery);

            // Check if the query was successful and that there are rows
            if ($result && $count = mysqli_fetch_assoc($countResult)) {

                // Access the count value directly
                $supportGroupSubmissionCount = $count['supportGroupSubmissionCount'];
                
                // Free the result set
                mysqli_free_result($countResult);
            } 

            // If the query was not successful, or there was not rows:
            else {
                $supportGroupSubmissionCount = 0;
            }

            echo'
            <p> <b>Support group members:</b> '.$supportGroupSubmissionCount.'</p>

            <div class="view-submissions-button"> <!-- view-submissions-buttons div start  -->
                <form method="post" class="submissions-method" action="supportGroupView.php">
                    <input type="hidden" name="viewSupportGroupID" value="' . $row['supportGroupID'] . '">
                    <button type="submit" name="viewSupportGroup">View members</button>
                </form>
            </div>
            </div><br> <!-- supportGroup-item end -->';
        } //While end
    } //Else if end
        
    /* Create supportGroups can only be done by the researchers, as it is being 
    implemented here: Researcher display start */
    if(userType() === 'researcher') {
        if (isset($_SESSION['researcher_name'])) {
        echo '
        <!-- Create supportGroup button -->
        <button onclick="supportGroupCreate()" class="create-btn"> <b>Create New Support Group</b>  </button>
        </div> <!-- created-supportGroups-list end -->';
        }
     } // Researcher display end

    echo '
    <h1>Joined Support Groups:</h1>
    <div class="supportGroup-list">';
    
        // Select support groups that the user has joined
        $selectJoinedSupportGroups = "SELECT s.* FROM supportGroup s
                                INNER JOIN user_supportGroup us ON s.supportGroupID = us.supportGroupID
                                WHERE us.userID = '$userID'";
        $resultJoinedSupportGroups = mysqli_query($conn, $selectJoinedSupportGroups);
    
        // If there are no support groups
        if (mysqli_num_rows($resultJoinedSupportGroups) == 0) {
            echo 'You have not joined any support groups yet.';
        }
    
        // If there are support groups
        else if (mysqli_num_rows($resultJoinedSupportGroups) > 0) {
    
            // While row in table exists via result
            while ($row = mysqli_fetch_assoc($resultJoinedSupportGroups)) {
    
                // Lists all support groups found
                echo '
                <div class="supportGroup-item">
                
                    <b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'] . '<br><br>

                    <div class="view-leave-buttons"> <!-- viewPost and leave buttons div start -->

                        <br><br><form method="post" class="viewPost-method" action="supportGroupPost.php">
                            <input type="hidden" name="viewSupportGroupID" value="' . $row['supportGroupID'] . '">
                            <button type="submit" name="viewSupportGroup">View posts</button>
                        </form>
                        
                        <form method="post" class="leave-method" action="">
                            <input type="hidden" name="leaveSupportGroupID" value="' . $row['supportGroupID'] . '">
                            <button type="submit" name="leaveSupportGroup">Leave support group</button>
                        </form>
                    </div> <!-- viewPost and leave buttons div start -->
                </div> <!-- supportGroup-item div end -->
                <br>';
            } // While end
        } // Else if end
        
        echo '
    </div> <!-- supportGroup-list end -->
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

    // If leaveSupportGroup is posted
    if (isset($_POST['leaveSupportGroup'])) {
        // Access the leaveSupportGroupID and sanitize the data
        $leaveSupportGroupID = mysqli_real_escape_string($conn, $_POST['leaveSupportGroupID']);

        // Delete from user_supportGroup where userID equals $userID and supportGroupID equals $leaveSupportGroupID
        $deleteUserSupportGroupQuery = "DELETE FROM user_supportGroup WHERE userID = '$userID' AND supportGroupID = '$leaveSupportGroupID'";

        // If the deletion query was successful
        if (mysqli_query($conn, $deleteUserSupportGroupQuery)) {
            echo "Left support group successfully!";
        } else {
            // If the deletion query failed
            echo "Error leaving support group: " . mysqli_error($conn);
        }
    }
}

/**
 * Summary of supportGroupEdit
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupEdit($name, $userID, $conn) { 
    //Initialize variables with default values
    $supportGroupName = '';
    $supportGroupDescription = '';
    $edittedSupportGroupID = '';

    //Checks if supportGroupID to edit is posted
    if (isset($_POST['editSupportGroupID'])) {

        //Access access and store the supportGroupID in a variable
        $edittedSupportGroupID = $_POST['editSupportGroupID'];

        //Store the data for the name and description from the supportgroup table via the $supportGroupID
        $selectedSupportGroupData = "SELECT `name`, `description` FROM `supportgroup` WHERE `supportGroupID` ='$edittedSupportGroupID';";
        $resultSupportGroupData = mysqli_query($conn, $selectedSupportGroupData);

        //If there is a result
        if ($resultSupportGroupData && mysqli_num_rows($resultSupportGroupData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSupportGroupData);

            //Info in the row to variables
            $supportGroupName = $row['name'];
            $supportGroupDescription = $row['description'];
        } //Inner if end
    } //Outer if end
    
    echo '
    <div class="edit-supportGroups">
    <h1>Hello <span>' . $name. '</span> this is the edit support group section</h1>';

    //Two forms, one for each part of the supportgroup table: ( `name`, `description`)
    echo '
    <form action="" method="post">
        <input type="hidden" name="editSupportGroupID" value="' . $edittedSupportGroupID . '">

        <!--$supportGroupName data as a placeholder for the name form-->
        <label for="supportGroupName"><b>Support Group Name:</b></label>
        <br>
        <input type="text" name="supportGroupName" value="' . $supportGroupName . '" class="form-input" required>
        <br><br>

        <!--$supportGroupDescription data as a placeholder for the description form-->
        <label for="supportGroupDescription"><b>SupportGroup Description:</b></label>
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
            echo "update successful";
            //header('location: supportGroupModify.php');
            //exit(); // Important to prevent further execution after the redirect
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //Outer if end
}

/**
 * Summary of supportGroupView
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupView($name, $userID, $conn) {
    // Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        }
    }

    // Initialize variables with default values
    $supportGroupName = '';
    $supportGroupDescription = '';
    $submittedSupportGroupID = '';

    // Checks if supportGroupID to view is posted
    if (isset($_POST['viewSupportGroupID'])) {

        // Access and store the supportGroupID in a variable
        $submittedSupportGroupID = $_POST['viewSupportGroupID'];

        // Store the data for the name and description from the support group table via the $supportGroupID
        $selectedSupportGroupData = "SELECT `name`, `description` FROM `supportGroup` WHERE `supportGroupID` = '$submittedSupportGroupID';";
        $resultSupportGroupData = mysqli_query($conn, $selectedSupportGroupData);

        // If there is a result for the name & description
        if ($resultSupportGroupData && mysqli_num_rows($resultSupportGroupData) > 0) {

            // Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultSupportGroupData);

            // Info in the row to variables
            $supportGroupName = $row['name'];
            $supportGroupDescription = $row['description'];
        }

        // Display support group name and description
        echo '
        <div class="view-submissions">
            <h1>Hello <span>' . $name . '</span>, this is the view support group section</h1>
            <div class="supportGroup-list">
                <div class="supportGroup-item">
                    <b>Name: </b><br>' . $supportGroupName . ' <br><br>
                    <b>Description: </b><br>' . $supportGroupDescription . '<br><br>';

        // Select user details from user_supportGroup and user tables
        $selectUserSupportGroup = "SELECT u.firstName, u.lastName, u.email
                                   FROM user_supportGroup usg
                                   INNER JOIN user u ON usg.userID = u.userID
                                   WHERE usg.supportGroupID = '$submittedSupportGroupID'";
        $resultUserSupportGroup = mysqli_query($conn, $selectUserSupportGroup);

        // If there are user details
        if ($resultUserSupportGroup && mysqli_num_rows($resultUserSupportGroup) > 0) {
            echo '<b>Members: </b><br>';

            // Loop through each user and display their first name and last name
            while ($userRow = mysqli_fetch_assoc($resultUserSupportGroup)) {
                echo '<b>Name: </b>' . $userRow['firstName'] . ' ' . $userRow['lastName'] . '<b> Email: </b>' . $userRow['email'] . '<br>';
            }
        }

        echo '
                </div><!-- supportGroup-item end -->
            </div><!-- supportGroup-list end -->

            <input type="button" onClick="window.location.href=\'supportGroupModify.php\'" name="cancel" value="Return" class="return-method"></input> <!-- Return button links to supportGroupModify.php-->
        </div><!-- view-submissions end -->';
    } // Outer if end
}

/**
 * Summary of supportGroupPost
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupPost($name, $userID, $conn) {
    // Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    }
    $submittedSupportGroupID = '';

    // Checks if supportGroupID to view is posted
    if (isset($_POST['viewSupportGroupID'])) {

        // Access and store the supportGroupID in a variable
        $submittedSupportGroupID = $_POST['viewSupportGroupID'];
    }
    elseif (isset($_POST['supportGroupID'])) {

        // Access and store the supportGroupID in a variable
        $submittedSupportGroupID = $_POST['supportGroupID'];
    }

    echo '
    <div class="search-supportGroups-box">
        <h1>Hello <span>' . $name . '</span>, this is the view support group posts section</h1>
        
        <form method="post" class="create-method" action="supportGroupPostCreate.php">
        <input type="hidden" name="supportGroupID" value="' . $submittedSupportGroupID . '">
        <button type="submit" name="createSupportGroup">Create post</button>
        </form>

        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes">
            <p style="display: block;"><b>Search By:</b></p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="supportGroup-search-name-box"><label for="search"><b>Name:</b></label><input type="text" name="searchName" placeholder="Support group name"></div>
            <div class="supportGroup-search-tag-box"><label for="tag"><b>Tags:</b></label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="supportGroupSearch" value="submit" type="submit">Search</button>
            </div> <!-- search-boxes end -->
        </form>

        <div class="supportGroup-list">';

        //Select from all support group posts
        $select = "SELECT * FROM supportgrouppost WHERE supportGroupID = '$submittedSupportGroupID';";
        $result = mysqli_query($conn, $select);

        //If there are no support group posts
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No support groups were found';
        }

        //If there are support group posts
        else if (mysqli_num_rows($result) > 0) {

            //While row in table exists via result
            while ( $row = mysqli_fetch_assoc($result) ) {

                //Lists all support group posts
                echo '<div class="supportGroup-item"> ';
                echo '<b>Name:</b> ' . $row['name'] . '<br>  <b>Description:</b> ' . $row['description'];
                
                // Join button to be displayed within the search section
                echo '<br><br>

                <div class="view-button"> <!-- view button div start -->';

                    echo '<form method="post" class="view-method" action="supportGroupPostComment.php">
                            <input type="hidden" name="supportGroupPostID" value="' . $row['postID'] . '">
                            <button type="submit" name="viewSupportGroup">View Comments</button>
                        </form>';

                echo '</div> <!-- view button div end -->
                </div> <!-- supportGroup-item div end -->
                <br>';
            } //While end
        } //Else if end

    echo'
        </div> <!-- supportGroup-list end -->
        <div class="search-supportGroup-list" style="display: none;">';

    //If supportGroupSearch is posted
    if (isset($_POST['supportGroupSearch'])) {
        echo '<script>hideSupportGroup();</script>';

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

                // Join button to be displayed within the search section
                echo '<br><br>

                <div class="view-button"> <!-- view button div start -->';


                    echo '<form method="post" class="view-method" action="supportGroupPostComment.php">
                            <input type="hidden" name="supportGroupPostID" value="' . $row['supportGroupID'] . '">
                            <button type="submit" name="viewSupportGroup">View Comments</button>
                        </form>';

                echo '</div> <!-- view button div end -->
                </div> <!-- supportGroup-item div end -->
                <br>';
            } //While end
        } //Else if end
        unset($_POST['supportGroupSearch']);
    } //If end
    echo'
        </div> <!-- search-supportGroups-list end -->
    </div> <!-- search-supportGroups-box end -->';

    // If joinSupportGroup is posted
    if (isset($_POST['joinSupportGroup'])) {
        // Access the supportGroupID from the posted data
        $joinSupportGroupID = mysqli_real_escape_string($conn, $_POST['joinSupportGroupID']);

        // Insert into user_supportGroup table only if not already joined
        $checkUserSupportGroup = "SELECT * FROM user_supportGroup WHERE userID = '$userID' AND supportGroupID = '$joinSupportGroupID'";
        $resultUserSupportGroup = mysqli_query($conn, $checkUserSupportGroup);

        if (mysqli_num_rows($resultUserSupportGroup) == 0) {
            // Insert into user_supportGroup table
            $insertUserSupportGroup = "INSERT INTO user_supportGroup (userID, supportGroupID) VALUES ('$userID', '$joinSupportGroupID')";

            if (mysqli_query($conn, $insertUserSupportGroup)) {
                // Insertion successful
                echo "Joined support group successfully!";
            } else {
                // Insertion failed
                echo "Error joining support group: " . mysqli_error($conn);
            }
        } else {
            // Display a message if already joined
            echo "You have already joined this support group.";
        }
    }
}
/**
 * Summary of supportGroupPostCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupPostCreate($name, $userID, $conn) {

    $submittedSupportGroupID = '';

    if (isset($_POST['createSupportGroup'])) {
        $submittedSupportGroupID = $_POST['supportGroupID'];
    }

    echo '
    <div class="modify-supportGroups">
        <div class="view-submissions">
        <h1>Hello <span>' . $name . '</span> this is the create support group post section</h1>

        <form action="" method="post"> <!-- form for create supportGroup info start-->
            <input type="hidden" name="supportGroupID" value="' . $submittedSupportGroupID . '">

            <label for="supportGroup_name"><b>Post name:</b></label><br>
            <input type="text" id="supportGroup_name" name="supportGroup_name" required placeholder="Support group name">
            <br><br>
        
            <label for="supportGroup_description"><b>Post description:</b></label><br>
            <input type="text" id="supportGroup_description" name="supportGroup_description" required placeholder="Support group description">
            <br><br>
        
            <input type="submit" name="createSupportGroupPost" value="Create post" class="form-btn">
        </form> <!-- form for create supportGroup info end-->

        <form method="post" class="cancel-button" action="supportGroupPost.php">
            <input type="hidden" name="supportGroupID" value="' . $submittedSupportGroupID . '">
        <button type="submit" name="cancelSupportGroup">Cancel</button>

        </form>
        </div> <!-- view-submissions end -->
    </div> <!-- modify-supportGroups end -->';

    //If createSupportGroup is posted
    if (isset($_POST['createSupportGroupPost'])) {

        //Create name and description variables from the posted data
        $name = mysqli_real_escape_string($conn, $_POST['supportGroup_name']);
        $description = mysqli_real_escape_string($conn, $_POST['supportGroup_description']);
        $supportgroupID = mysqli_real_escape_string($conn, $_POST['supportGroupID']);

    // Insert into supportgrouppost table with explicit column names
    $insert = "INSERT INTO `supportgrouppost` (`postID`, `supportGroupID`, `userID`, `name`, `description`) VALUES (NULL, '$supportgroupID', '$userID', '$name', '$description');";
       
        //If query was successful
        if (mysqli_query($conn, $insert)) {
            echo "Support group post inserted successfully!";
        }

        //If query was not successful
        else { 
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createSupportGroupPost']);
    } //If end
}

/**
 * Summary of supportGroupPostComment
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function supportGroupPostComment($name, $userID, $conn) {
    // Checks if supportGroupPostID to view is posted
    if (isset($_POST['supportGroupPostID'])) {
        // Access and store the supportGroupPostID in a variable
        $supportGroupPostID = mysqli_real_escape_string($conn, $_POST['supportGroupPostID']);
    } elseif (isset($_POST['postID'])) {
        $supportGroupPostID = mysqli_real_escape_string($conn, $_POST['postID']);
    } else {
        // Display an error message if supportGroupPostID is not set
        echo '<div class="error-msg">Post ID not set</div>';
    }

    // Select data from supportgrouppost based on the supportGroupPostID
    $selectResponse = "SELECT * FROM supportgrouppost WHERE postID = '$supportGroupPostID'";
    $resultResponse = mysqli_query($conn, $selectResponse);

    // Display post information if available
    if ($row = mysqli_fetch_assoc($resultResponse)) {
        $postName = $row['name'];
        $postDescription = $row['description'];
        $supportGroupID = $row['supportGroupID'];
    } else {
        // Display an error message if no matching supportgrouppost record is found
        echo '<div class="error-msg">Post not found</div>';
    }

    echo '
    <div class="modify-supportGroups">
        <div class="view-submissions">
            <h1>Hello <span>' . $name . '</span>, this is the create support group post comment section</h1>
            <div class="post-list"> 
                <div class="post-box">                    
                    <p>Post Name: ' . $postName . '</p>
                    <p>Post Description: ' . $postDescription . '</p>
                    ' . $supportGroupPostID . '' . $supportGroupID . '
                </div> <!-- post-box end -->';

    // Select data from supportgrouppost based on the supportGroupPostID
    $selectComments = "SELECT * FROM supportgroupcomment WHERE postID = '$supportGroupPostID'";
    $result = mysqli_query($conn, $selectComments);

    //If there are no support groups
    if (mysqli_num_rows($result) == 0) {
        $error[] = 'No support groups were found';
    }

    //If there are support groups
    else if (mysqli_num_rows($result) > 0) {

        //While row in the table exists via result
        while ($row = mysqli_fetch_assoc($result)) {
            $commentUserID = $row['userID'];

            // Fetch user's first and last names based on commentUserID
            $selectUser = "SELECT firstName, lastName FROM user WHERE userID = '$commentUserID'";
            $resultUser = mysqli_query($conn, $selectUser);
            $rowUser = mysqli_fetch_assoc($resultUser);

            // Display user's first and last names above the comment
            $commentUserName = $rowUser['firstName'] . ' ' . $rowUser['lastName'];

            // Lists support groups where name and tag are included in the search fields
            echo '
                <div class="post-list"> 
                    <div class="comment-box"> 
                        <p>' . $commentUserName . ' said: <br>' . $row['comment'] . '</p>
                    </div>
                </div>';
        }
    }
    echo '
            <!-- Form for adding a comment -->
            <form method="post" action="">
                <input type="hidden" name="supportGroupID" value="' . $supportGroupID . '">
                <input type="hidden" name="postID" value="' . $supportGroupPostID . '">
                <label for="question">Add a comment:<br></label>
                <input type="text" id="question" name="question" required placeholder="Type your comment here"><br><br>
                <button type="submit" name="submitComment">Submit Comment</button>
            </form>
            <br>       
            <!-- Form for canceling -->
            <form method="post" class="cancel-button" action="supportGroupPost.php">
                <input type="hidden" name="supportGroupID" value="' . $supportGroupID . '">
                <button type="submit" name="cancelSupportGroup">Cancel</button>
            </form>
        </div> <!-- view-submissions end -->
    </div> <!-- modify-supportGroups end -->';

    // Check if the comment is set in the $_POST data
    if (isset($_POST['submitComment'])) {
        // Access and store the comment in a variable
        $comment = mysqli_real_escape_string($conn, $_POST['question']);
        $supportGroupNewID = mysqli_real_escape_string($conn, $_POST['supportGroupID']);
        $postID = mysqli_real_escape_string($conn, $_POST['supportGroupID']);

        // Insert the comment into the supportgroupcomment table
        $insertComment = "INSERT INTO supportgroupcomment (commentID, supportGroupID, postID, userID, comment) VALUES (NULL, '$supportGroupNewID', '$postID', '$userID', '$comment')";

        if (mysqli_query($conn, $insertComment)) {
            echo '<div class="success-msg">Comment submitted successfully!</div>';
        } else {
            echo '<div class="error-msg">Error submitting comment: ' . mysqli_error($conn) . '</div>';
        }
    }
}


/**
 * Summary of studySearch
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function studySearch($name, $userID, $conn) {
    // Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    }
    echo '
    <div class="search-studies-box">
        <h1>Hello <span>' . $name . '</span> this is the search study section</h1>
        <form action="" method="post"> <!-- Buttons for the search -->
            <div class="search-boxes">
            <p style="display: block;"><b>Search By:</b></p> <br><br>
            <!-- Added labels to the search boxes -->
            <div class="study-search-name-box"><label for="search"><b>Name:</b></label><input type="text" name="searchName" placeholder="Study name"></div>
            <div class="study-search-tag-box"><label for="tag"><b>Tags:</b></label><input type="text" name="searchTag" placeholder="Tag name"></div>
            <button name="studySearch" value="submit" type="submit">Search</button>
            </div> <!-- search-boxes end -->
        </form>

        <div class="study-list">';

        // Select from all studies
        $select = "SELECT * FROM study";
        $result = mysqli_query($conn, $select);

        // If there are no studies
        if (mysqli_num_rows($result) == 0) {
            $error[] = 'No studies were found';
        }

        // If there are studies
        else if (mysqli_num_rows($result) > 0) {

            // While row in table exists via result
            while ($row = mysqli_fetch_assoc($result)) {

                // Lists all studies
                echo '
                <div class="study-item">
                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br>';

                // Join button to be displayed within the search section
                echo '<br>
                
                <div class="join-button"> <!-- join button div start -->';

                // Check if a row exists in user_study for the specified userID and studyID
                $checkUserStudy = "SELECT * FROM user_study WHERE userID = '$userID' AND studyID = '" . $row['studyID'] . "'";
                $resultUserStudy = mysqli_query($conn, $checkUserStudy);

                if (mysqli_num_rows($resultUserStudy) == 0) {
                    // If no row exists, display the "Join Study" button
                    echo '<form method="post" class="join-method" action="">
                            <input type="hidden" name="joinStudyID" value="' . $row['studyID'] . '">
                            <button type="submit" name="joinStudy">Join study</button>
                        </form>';
                } else {
                    // If a row exists, display a message
                    echo 'You have already joined this study.';
                }

                echo '</div> <!-- join button div end -->
                </div> <!-- study-item div end -->
                <br>';
            } // While end
        } // Else if end

        echo '
        </div> <!-- study-list end -->
        <div class="search-study-list" style="display: none;">';

        // If studySearch is posted
        if (isset($_POST['studySearch'])) {
            echo '<script>hideAll();</script>';

            // Access searchName and searchTag variables from the posted data
            $searchName = mysqli_real_escape_string($conn, $_POST['searchName']);
            $searchTag = mysqli_real_escape_string($conn, $_POST['searchTag']);

            // Select from study table where name variable is similar
            $select = "SELECT * FROM study WHERE name LIKE '%$searchName%'";
            $result = mysqli_query($conn, $select);

            // If there are no studies
            if (mysqli_num_rows($result) == 0) {
                $error[] = 'No studies were found';
            }

            // If there are studies
            else if (mysqli_num_rows($result) > 0) {

                // While row in table exists via result
                while ($row = mysqli_fetch_assoc($result)) {

                    // Lists studies where name and tag are included in the search fields
                    echo '
                    <div class="study-item">
                        <b>Name:</b> ' . $row['name'] . '<br>
                        <b>Description:</b> ' . $row['description'] . '<br>
                        <b>Location:</b> ' . $row['location'] . '<br>
                        <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                        <b>Compensation:</b> ' . $row['compensation'] . '<br>
                    </div><br>';
                } // While end
            } // Else if end
            unset($_POST['studySearch']);
        } // If end

        echo '
        </div> <!-- search-studies-list end -->
    </div> <!-- search-studies-box end -->';

    // If joinStudy is posted
    if (isset($_POST['joinStudy'])) {
        // Access the study ID from the posted data
        $joinStudyID = mysqli_real_escape_string($conn, $_POST['joinStudyID']);

        // Insert into user_study table only if not already joined
        $checkUserStudy = "SELECT * FROM user_study WHERE userID = '$userID' AND studyID = '$joinStudyID'";
        $resultUserStudy = mysqli_query($conn, $checkUserStudy);

        if (mysqli_num_rows($resultUserStudy) == 0) {
            // Insert into user_study table
            $insertUserStudy = "INSERT INTO user_study (userID, studyID) VALUES ('$userID', '$joinStudyID')";

            if (mysqli_query($conn, $insertUserStudy)) {
                // Insertion successful
                echo "Joined study successfully!";
            } else {
                // Insertion failed
                echo "Error joining study: " . mysqli_error($conn);
            }
        } else {
            // Display a message if already joined
            echo "You have already joined this study.";
        }
    }
}


/**
 * Summary of studyCreate
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function studyCreate($name, $userID, $conn) {

    echo '
    <div class="create-studies">
    <h1>Hello <span>' . $name . '</span> this is the create study section</h1>

    <form action="" method="post"> <!-- form for create study info start-->
        <label for="studyname"><b>Study name:</b></label><br><!-- studyName button -->
        <input type="text" id="study_name" name="study_name" required placeholder="Study name">
        <br><br>

        <label for="studydescription"><b>Study description:</b></label><br><!-- studyDescription button -->
        <input type="text" id="study_description" name="study_description" required placeholder="Study description">
        <br><br>
        
        <label for="studylocation"><b>Study location:</b></label><br><!-- studyLocation button -->
        <input type="text" id="study_location" name="study_location" required placeholder="Study location">
        <br><br>
        
        <label for="studydate"><b>Study date:</b></label><br><!-- studyDate button -->
        <input type="datetime-local" id="study_date" name="study_date" required placeholder="Study date">
        <br><br>
        
        <label for="studycompensation"><b>Study compensation amount: ( Leave at 0 if none )</b></label><br><!-- studyCompensation button -->
        <input type="number" id="study_compensation" name="study_compensation" placeholder="0" min="0">
        <br><br>
        
        <label for="studytags"><b>Study tag(s):</b></label><br> <!-- studyTags button -->
        <input type="text" id="study_tags" name="study_tags" required placeholder="Study tag(s)">
        <br><br>
        
        <input type="submit" name="createStudy" value="Create new study" class="form-btn"> <!-- createStudy button -->
        <input type="button" onClick="window.location.href=\'studyModify.php\'" name="cancel" value="cancel" class="cancel-link"></input> <!-- cancel button links to studyModify.php-->
        <br><br>
	</form> <!-- form for create study info end-->
    </div> <!-- create-studies end -->';

    //If createStudy is posted
    if (isset($_POST['createStudy'])) {

        //Create name and description variables from the posted data
        $name = mysqli_real_escape_string($conn, $_POST['study_name']);
        $description = mysqli_real_escape_string($conn, $_POST['study_description']);
        $location = mysqli_real_escape_string($conn, $_POST['study_location']);
        $date = mysqli_real_escape_string($conn, $_POST['study_date']);
        $compensation = mysqli_real_escape_string($conn, $_POST['study_compensation']);
        //$tags = mysqli_real_escape_string($conn, $_POST['study_tags']);

        //Insert into study table with the created variables
        $insert = "INSERT INTO `study` (`studyID`, `ownerID`, `name`, `description`, `location`, `date`, `compensation`) VALUES (NULL, '$userID', '$name', '$description', '$location', '$date', '$compensation');";
        //If query was successful
        if (mysqli_query($conn, $insert)) {
            echo "Study inserted successfully!";
        }

        //If query was not successful
        else { 
            echo "Error: " . mysqli_error($conn);
        }
        unset($_POST['createStudy']);
    } //If end
}

/**
 * Summary of studyModify
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function studyModify($name, $userID, $conn) {
    echo '
    <div class="modify-studies">
    <h1>Hello <span>' . $name . '</span> this is the manage study section</h1>

    <h1> Created Studies: </h1>
    <div class="created-studies-list">';

    //Select from study table where userID is equal
    $select = "SELECT * FROM study WHERE `ownerID` = '$userID';";
    $result = mysqli_query($conn, $select);
  
    unset($_SESSION['editStudyID']);

    //If no studies were found
    if (mysqli_num_rows($result) == 0) {
        echo '<h1>No studies were found</h1>';
    }

    //If there are studies
    else if (mysqli_num_rows($result) > 0) {

        //While row in table exists via result
        while ($row = mysqli_fetch_assoc($result)) { 

            //Lists studies where where userID is equal
            echo '<div class="study-item">
                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br>';
                    
                // Research name display
            if(userType() === 'researcher') {        
                if (isset($_SESSION['researcher_name'])) {    
                    echo'
                        <div class="edit-delete-buttons"> <!-- edit and delete buttons div start  -->
            
                            <form method="post" class="edit-method" action="studyEdit.php">
                                <input type="hidden" name="editStudyID" value="' . $row['studyID'] . '">
                                <button type="submit" name="editStudy">Edit</button>
                            </form>';
   
                    echo'
                    <!-- deleteStudy button -->
                        <form method="post" action="" class="delete-method" onsubmit="return confirm(\'Are you sure you want to delete this study?\');">
                            <input type="hidden" name="study_id" value="' . $row['studyID'] . '">
                            <button name="deleteStudy" value="submit" type="submit">Delete</button>
                        </form>
                        </div> <!-- edit and delete buttons div start  -->';
                }
            } 
            // SQL query to count the distinct rows
            $countQuery = "SELECT COUNT(DISTINCT `userID`) AS studySubmissionCount FROM `user_study` WHERE `studyID` = '{$row['studyID']}';";
            $countResult = mysqli_query($conn, $countQuery);

            // Check if the query was successful and that there are rows
            if ($result && $count = mysqli_fetch_assoc($countResult)) {

                // Access the count value directly
                $studySubmissionCount = $count['studySubmissionCount'];
                
                // Free the result set
                mysqli_free_result($countResult);
            } 
            
            // If the query was not successful, or there was not rows:
            else {
                $studySubmissionCount = 0;
            }

            echo'
            <p> <b>Study members:</b> '.$studySubmissionCount.'</p>

            <div class="view-submissions-button"> <!-- view-submissions-buttons div start  -->
                <form method="post" class="submissions-method" action="studyView.php">
                    <input type="hidden" name="viewStudyID" value="' . $row['studyID'] . '">
                    <button type="submit" name="viewStudy">View joined members</button>
                </form>
            </div>';
            echo '   
            </div><br> <!-- study-item end -->'; 
        } //While end
    } //Else if end

    /* Create studies can only be done by the researchers, as it is being 
    implemented here: Researcher display start */
    if(userType() === 'researcher') {
        if (isset($_SESSION['researcher_name'])) {
            echo '
            <!-- Create study button -->
            <button onclick="studyCreate()" class="create-btn"> <b>Create New Study</b>  </button>
            </div> <!-- created-studies-list end -->';
        }
     } // Researcher display end

    echo '
    <h1>Joined Studies:</h1>
    <div class="study-list">';
    
        // Select studies that the user has joined
        $selectJoinedStudies = "SELECT s.* FROM study s
                                INNER JOIN user_study us ON s.studyID = us.studyID
                                WHERE us.userID = '$userID'";
        $resultJoinedStudies = mysqli_query($conn, $selectJoinedStudies);
    
        // If there are no studies
        if (mysqli_num_rows($resultJoinedStudies) == 0) {
            echo 'You have not joined any studies yet.';
        }
    
        // If there are studies
        else if (mysqli_num_rows($resultJoinedStudies) > 0) {
    
            // While row in table exists via result
            while ($row = mysqli_fetch_assoc($resultJoinedStudies)) {
    
                // Lists all studies
                echo '
                <div class="study-item">
                    <b>Name:</b> ' . $row['name'] . '<br>
                    <b>Description:</b> ' . $row['description'] . '<br>
                    <b>Location:</b> ' . $row['location'] . '<br>
                    <b>Date:</b> ' . date('Y-m-d H:i:s', strtotime($row['date'])) . '<br>
                    <b>Compensation:</b> ' . $row['compensation'] . '<br><br>';
    
                    echo '<form method="post" class="leave-method" action="">
                            <input type="hidden" name="leaveStudyID" value="' . $row['studyID'] . '">
                            <button type="submit" name="leaveStudy">Leave study</button>
                        </form>';

                echo '</div> <!-- study-item div end -->
                <br>';
            } // While end
        } // Else if end
        
        echo '
    </div> <!-- study-list end -->
    
    </div> <!-- modify-studies end -->
    ';

    //If deleteStudy is posted
    if (isset($_POST['deleteStudy'])) {

        //Creates studyID variable from the posted data
        $studyID = mysqli_real_escape_string($conn, $_POST['study_id']);

        //Delete from study table where studyID is equal
        $deleteQuery = "DELETE FROM study WHERE studyID = '$studyID';";
       
        //If query was successful
        if (mysqli_query($conn, $deleteQuery)) { 
            echo "Study deleted successfully!";
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //If end

    // If leaveStudy is posted
    if (isset($_POST['leaveStudy'])) {
        // Access the leaveStudyID and sanitize the data
        $leaveStudyID = mysqli_real_escape_string($conn, $_POST['leaveStudyID']);

        // Delete from user_study where userID equals $userID and studyID equals $leaveStudyID
        $deleteUserStudyQuery = "DELETE FROM user_study WHERE userID = '$userID' AND studyID = '$leaveStudyID'";

        // If the deletion query was successful
        if (mysqli_query($conn, $deleteUserStudyQuery)) {
            echo "Left study successfully!";
        } else {
            // If the deletion query failed
            echo "Error leaving study: " . mysqli_error($conn);
        }
    }
}

/**
 * Summary of studyEdit
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function studyEdit($name, $userID, $conn) { 
    //Initialize variables with default values
    $studyName = '';
    $studyDescription = '';
    $studyLocation = '';
    $studyDate = '';
    $studyCompensation = '';
    $edittedStudyID = '';

    //Checks if studyID to edit is posted
    if (isset($_POST['editStudyID'])) {

        //Access access and store the studyID in a variable
        $edittedStudyID = $_POST['editStudyID'];

        //Store the data for the name and description from the study table via the $studyID
        $selectedStudyData = "SELECT `name`, `description`, `location`, `date`, `compensation` FROM `study` WHERE `studyID` ='$edittedStudyID';";
        $resultStudyData = mysqli_query($conn, $selectedStudyData);

        //If there is a result
        if ($resultStudyData && mysqli_num_rows($resultStudyData) > 0) {

            //Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultStudyData);

            //Info in the row to variables
            $studyName = $row['name'];
            $studyDescription = $row['description'];
            $studyLocation = $row['location'];
            $studyDate = $row['date'];
            $studyCompensation = $row['compensation'];
        } //Inner if end
    } //Outer if end
    
    echo '
    <div class="edit-studies">
    <h1>Hello <span>' . $name. '</span> this is the edit study section</h1>';

    //Five forms, one for each part of the study table: ( `name`, `description`, `location`, `date`, `compensation`)
    echo '
    <form action="" method="post">

        <input type="hidden" name="editStudyID" value="' . $edittedStudyID . '">

        <!--$studyName data as a placeholder for the name form-->
        <label for="studyName"><b>Study Name:</b></label>
        <br>
        <input type="text" name="studyName" value="' . $studyName . '" class="form-input" required>
        <br><br>

        <!--$studyDescription data as a placeholder for the description form-->
        <label for="studyDescription"><b>Study Description:</b></label>
        <br>
        <textarea name="studyDescription" class="form-textarea" required>' . $studyDescription . '</textarea>
        <br><br>

        <!--$studyLocation data as a placeholder for the location form-->
        <label for="studyLocation"><b>Study Location:</b></label>
        <br>
        <input type="text" name="studyLocation" value="' . $studyLocation . '" class="form-input" required>
        <br><br>

        <!--$studyDate data as a placeholder for the date form-->
        <label for="studyDate"><b>Study Date:</b></label>
        <br>
        <input type="datetime-local" name="studyDate" value="' . date('Y-m-d\TH:i', strtotime(str_replace(' ', 'T', $studyDate))) . '" class="form-input" required>
        <br><br>

        <!--$studyCompensation data as a placeholder for the compensation form-->
        <label for="studyCompensation"><b>Study Compensation:</b></label>
        <br>
        <input type="text" name="studyCompensation" value="' . $studyCompensation . '" class="form-input">
        <br><br>

        <!--Submit form that posts updateStudy-->
        <input type="submit" name="updateStudy" value="Submit" class="form-btn">

        <!--Cancel button links to studyModify.php-->
        <input type="button" onClick="window.location.href=\'studyModify.php\'" name="cancel" value="Cancel" class="cancel-link">
        <br>
    </form>
    </div> <!-- edit-studies end -->';

    //If updateStudy is posted
    if (isset($_POST['updateStudy'])) {

        //Create name and description variables from the posted data
        $studyName = mysqli_real_escape_string($conn, $_POST['studyName']);
        $studyDescription = mysqli_real_escape_string($conn, $_POST['studyDescription']);
        $studyLocation = mysqli_real_escape_string($conn, $_POST['studyLocation']);
        $studyDate = mysqli_real_escape_string($conn, $_POST['studyDate']);
        $studyCompensation = mysqli_real_escape_string($conn, $_POST['studyCompensation']);

        //Update the study table row name and description column where the $studyID is equal
        $editQuery = "UPDATE `study` SET `name` = '$studyName', `description` = '$studyDescription', `location`='$studyLocation', `date`='$studyDate', `compensation`='$studyCompensation' WHERE `study`.`studyID` = '$edittedStudyID';";
        
        //If query was successful
        if (mysqli_query($conn, $editQuery)) {
            echo "update successful ";
            //header('location: studyModify.php');
            //exit(); // Important to prevent further execution after the redirect
        }

        //If query was not successful
        else {
            echo "Error: " . mysqli_error($conn);
        }
    } //Outer if end
}

/**
 * Summary of studyView
 * @param mixed $name
 * @param mixed $userID
 * @param mixed $conn
 * @return void
 */
function studyView($name, $userID, $conn) {
    // Used to display errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        }
    }

    // Initialize variables with default values
    $studyName = '';
    $studyDescription = '';
    $studyLocation = '';
    $studyDate = '';
    $studyCompensation = '';
    $submittedStudyID = '';

    // Checks if studyID to view is posted
    if (isset($_POST['viewStudyID'])) {

        // Access and store the studyID in a variable
        $submittedStudyID = $_POST['viewStudyID'];

        // Store the data for the name and description from the support group table via the $studyID
        $selectedStudyData = "SELECT * FROM `study` WHERE `studyID` = '$submittedStudyID';";
        $resultStudyData = mysqli_query($conn, $selectedStudyData);

        // If there is a result for the name & description
        if ($resultStudyData && mysqli_num_rows($resultStudyData) > 0) {

            // Make row variable to save name and description
            $row = mysqli_fetch_assoc($resultStudyData);

            // Info in the row to variables
            $studyName = $row['name'];
            $studyDescription = $row['description'];
            $studyLocation = $row['location'];
            $studyDate = $row['date'];
            $studyCompensation = $row['compensation'];
        }

        // Display support group name and description
        echo '
        <div class="view-submissions">
            <h1>Hello <span>' . $name . '</span>, this is the view support group section</h1>
            <div class="study-list">
                <div class="study-item">
                    <b>Name: </b><br>' . $studyName . ' <br><br>
                    <b>Description: </b><br>' . $studyDescription . '<br><br>
                    <b>Location: </b><br>' . $studyLocation . '<br><br>
                    <b>Date: </b><br>' . date('Y-m-d H:i:s', strtotime($studyDate)) . '<br><br>
                    <b>Compensation: </b><br>' . $studyCompensation . '<br><br>';

        // Select user details from user_study and user tables
        $selectUserStudy = "SELECT u.firstName, u.lastName, u.email
                                   FROM user_study us
                                   INNER JOIN user u ON us.userID = u.userID
                                   WHERE us.studyID = '$submittedStudyID'";
        $resultUserStudy = mysqli_query($conn, $selectUserStudy);

        // If there are user details
        if ($resultUserStudy && mysqli_num_rows($resultUserStudy) > 0) {
            echo '<b>Members: </b><br>';

            // Loop through each user and display their first name and last name
            while ($userRow = mysqli_fetch_assoc($resultUserStudy)) {
                echo '<b>Name: </b>' . $userRow['firstName'] . ' ' . $userRow['lastName'] . '<b> Email: </b>' . $userRow['email'] . '<br>';
            }
        }

        echo '
                </div><!-- study-item end -->
            </div><!-- study-list end -->

            <input type="button" onClick="window.location.href=\'studyModify.php\'" name="cancel" value="Return" class="return-method"></input> <!-- Return button links to studyModify.php-->
        </div><!-- view-submissions end -->';
    } // Outer if end
}
?>
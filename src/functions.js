function surveySearch() {
    document.querySelector('.search-surveys').style.display = 'block';
    document.querySelector('.survey-list').style.display = 'flex';
    document.querySelector('.survey-item').style.width = '50%';
    document.querySelector('.search-survey-list').style.display = 'none';
    document.querySelector('.create-surveys').style.display = 'none';
    document.querySelector('.modify-surveys').style.display = 'none';
}

// Displays the surveyCreate div, and hides the others
function surveyCreate() {
    document.querySelector('.create-surveys').style.display = 'block';
    document.querySelector('.modify-surveys').style.display = 'none';
}

// Displays the surveyEdit div, and hides the others
function surveyEditer() {
    document.querySelector('.create-surveys').style.display = 'none';
    document.querySelector('.modify-surveys').style.display = 'none';
}

// Displays the surveyModify div, and hides the others
function surveyModify() {
    document.querySelector('.search-surveys').style.display = 'none';
    document.querySelector('.create-surveys').style.display = 'none';
    document.querySelector('.modify-surveys').style.display = 'block';
    document.querySelector('.edit-surveys').style.display = 'none';

}

// Displays the surveyDelete div, and hides the others
function surveyDelete() {
    document.querySelector('.search-surveys').style.display = 'none';
    document.querySelector('.create-surveys').style.display = 'none';
    document.querySelector('.modify-surveys').style.display = 'none';
}

// Displays the opportunitySearch div, and hides the others
function opportunitySearch() {
    document.querySelector('.search-opportunities').style.display = 'block';
    document.querySelector('.create-opportunities').style.display = 'none';
    document.querySelector('.modify-opportunities').style.display = 'none';
    document.querySelector('.delete-opportunities').style.display = 'none';
}

// Displays the opportunityCreate div, and hides the others
function opportunityCreate() {
    document.querySelector('.search-opportunities').style.display = 'none';
    document.querySelector('.create-opportunities').style.display = 'block';
    document.querySelector('.modify-opportunities').style.display = 'none';
    document.querySelector('.delete-opportunities').style.display = 'none';
}

// Displays the opportunityModify div, and hides the others
function opportunityModify() {
    document.querySelector('.search-opportunities').style.display = 'none';
    document.querySelector('.create-opportunities').style.display = 'none';
    document.querySelector('.modify-opportunities').style.display = 'block';
    document.querySelector('.delete-opportunities').style.display = 'none';
}

// Displays the opportunityDelete div, and hides the others
function opportunityDelete() {
    document.querySelector('.search-opportunities').style.display = 'none';
    document.querySelector('.create-opportunities').style.display = 'none';
    document.querySelector('.modify-opportunities').style.display = 'none';
    document.querySelector('.delete-opportunities').style.display = 'block';
}

// Displays the supportGroupSearch div, and hides the others
function supportGroupSearch() {
    document.querySelector('.search-supportGroups').style.display = 'block';
    document.querySelector('.create-supportGroups').style.display = 'none';
    document.querySelector('.modify-supportGroups').style.display = 'none';
    document.querySelector('.delete-supportGroups').style.display = 'none';
}

// Displays the supportGroupCreate div, and hides the others
function supportGroupCreate() {
    document.querySelector('.search-supportGroups').style.display = 'none';
    document.querySelector('.create-supportGroups').style.display = 'block';
    document.querySelector('.modify-supportGroups').style.display = 'none';
    document.querySelector('.delete-supportGroups').style.display = 'none';
}

// Displays the supportGroupModify div, and hides the others
function supportGroupModify() {
    document.querySelector('.search-supportGroups').style.display = 'none';
    document.querySelector('.create-supportGroups').style.display = 'none';
    document.querySelector('.modify-supportGroups').style.display = 'block';
    document.querySelector('.delete-supportGroups').style.display = 'none';
}

// Displays the supportGroupDelete div, and hides the others
function supportGroupDelete() {

    document.querySelector('.search-supportGroups').style.display = 'none';
    document.querySelector('.create-supportGroups').style.display = 'none';
    document.querySelector('.modify-supportGroups').style.display = 'none';
    document.querySelector('.delete-supportGroups').style.display = 'block';
}

// Displays the studySearch div, and hides the others
function studySearch() {
    document.querySelector('.search-studies').style.display = 'block';
	document.querySelector('.study-list').style.display = 'flex';
    document.querySelector('.study-item').style.width = '50%';
    document.querySelector('.search-study-list').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'none';
    document.querySelector('.modify-studies').style.display = 'none';
    document.querySelector('.delete-studies').style.display = 'none';
}

// Displays the studyCreate div, and hides the others
function studyCreate() {
    document.querySelector('.search-studies').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'block';
    document.querySelector('.modify-studies').style.display = 'none';
    document.querySelector('.delete-studies').style.display = 'none';
}

// Displays the studyModify div, and hides the others
function studyModify() {
    document.querySelector('.search-studies').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'none';
    document.querySelector('.modify-studies').style.display = 'block';
    document.querySelector('.delete-studies').style.display = 'none';
}

// Displays the studyDelete div, and hides the others
function studyDelete() {
    document.querySelector('.search-studies').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'none';
    document.querySelector('.modify-studies').style.display = 'none';
    document.querySelector('.delete-studies').style.display = 'block';
}

// Used to hide specific modules when necessary
function hideAll() {
    document.querySelector('.survey-list').style.display = 'none';
    /* Changed the display of the search-survey-list in this function */
    document.querySelector('.search-survey-list').style.display = 'flex';
    document.querySelector('.survey-item').style.width = '50%';
}


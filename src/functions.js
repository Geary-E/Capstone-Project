// Displays the surveySearch div, and hides the others

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
    document.querySelector('.opportunity-list').style.display = 'flex';
    document.querySelector('.opportunity-item').style.width = '50%';
    document.querySelector('.search-opportunity-list').style.display = 'none';
    document.querySelector('.create-opportunities').style.display = 'none';
    document.querySelector('.modify-opportunities').style.display = 'none';
}

// Displays the opportunityCreate div, and hides the others
function opportunityCreate() {
    document.querySelector('.create-opportunities').style.display = 'block';
    document.querySelector('.modify-opportunities').style.display = 'none';
}

// Displays the opportunityModify div, and hides the others
function opportunityModify() {
    document.querySelector('.search-opportunities').style.display = 'none';
    document.querySelector('.create-opportunities').style.display = 'none';
    document.querySelector('.modify-opportunities').style.display = 'block';
    document.querySelector('.edit-opportunities').style.display = 'none';
}

// Displays the opportunityDelete div, and hides the others
function opportunityDelete() {
    document.querySelector('.search-opportunities').style.display = 'none';
    document.querySelector('.create-opportunities').style.display = 'none';
    document.querySelector('.modify-opportunities').style.display = 'none';
}

// Displays the supportGroupSearch div, and hides the others
function supportGroupSearch() {
    document.querySelector('.search-supportGroups').style.display = 'block';
    document.querySelector('.supportGroup-list').style.display = 'flex';
    document.querySelector('.supportGroup-item').style.width = '50%';
    document.querySelector('.search-supportGroup-list').style.display = 'none';
    document.querySelector('.create-supportGroups').style.display = 'none';
    document.querySelector('.modify-supportGroups').style.display = 'none';
}

// Displays the supportGroupCreate div, and hides the others
function supportGroupCreate() {
    document.querySelector('.create-supportGroups').style.display = 'block';
    document.querySelector('.modify-supportGroups').style.display = 'none';
}

// Displays the supportGroupModify div, and hides the others
function supportGroupModify() {
    document.querySelector('.search-supportGroups').style.display = 'none';
    document.querySelector('.create-supportGroups').style.display = 'none';
    document.querySelector('.modify-supportGroups').style.display = 'block';
    document.querySelector('.edit-supportGroups').style.display = 'none';
}

// Displays the supportGroupDelete div, and hides the others
function supportGroupDelete() {
    document.querySelector('.search-supportGroups').style.display = 'none';
    document.querySelector('.create-supportGroups').style.display = 'none';
    document.querySelector('.modify-supportGroups').style.display = 'none';
}

// Displays the studySearch div, and hides the others
function studySearch() {
    document.querySelector('.search-studies').style.display = 'block';
    document.querySelector('.study-list').style.display = 'flex';
    document.querySelector('.study-item').style.width = '50%';
    document.querySelector('.search-study-list').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'none';
    document.querySelector('.modify-studies').style.display = 'none';
}

// Displays the studyCreate div, and hides the others
function studyCreate() {
    document.querySelector('.create-studies').style.display = 'block';
    document.querySelector('.modify-studies').style.display = 'none';
}

// Displays the studyModify div, and hides the others
function studyModify() {
    document.querySelector('.search-studies').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'none';
    document.querySelector('.modify-studies').style.display = 'block';
    document.querySelector('.edit-studies').style.display = 'none';
}

// Displays the studyDelete div, and hides the others
function studyDelete() {
    document.querySelector('.search-studies').style.display = 'none';
    document.querySelector('.create-studies').style.display = 'none';
    document.querySelector('.modify-studies').style.display = 'none';
}

// Used to hide specific modules when necessary
function hideAll() {
    document.querySelector('.survey-list').style.display = 'none';
    document.querySelector('.search-survey-list').style.display = 'flex';
    document.querySelector('.survey-item').style.width = '50%';

    document.querySelector('.opportunity-list').style.display = 'none'
    document.querySelector('.search-opportunity-list').style.display = 'flex';
    document.querySelector('.opportunity-item').style.width = '50%';

    document.querySelector('.supportGroup-list').style.display = 'none'
    document.querySelector('.search-supportGroup-list').style.display = 'flex';
    document.querySelector('.supportGroup-item').style.width = '50%';
	
	document.querySelector('.study-list').style.display = 'none'
    document.querySelector('.search-study-list').style.display = 'flex';
    document.querySelector('.study-item').style.width = '50%';
}

// Used to display the FAQ section when clicked on in the Account Page 
function faq() {
    document.querySelector('.faq-section').style.display = 'block';
    document.querySelector('.compensation-section').style.display = 'none';
    document.querySelector('.account-page-box').style.display = 'none';
    document.querySelector('.faq-list').style.display = 'flex';

}

// Used to display the Compensation section when clicked on in the Account Page 
function accountCompensation() {
    document.querySelector('.compensation-listing').style.display = 'flex';
    document.querySelector('.compensation-section').style.display = 'block';
    document.querySelector('.account-page-box').style.display = 'none';
    document.querySelector('.faq-section').style.display = 'none';
}


// Used to display the General section on the account page 
function generalAccountDisplay() {
    document.querySelector('.account-page-box').style.display = 'block';
    document.querySelector('.compensation-section').style.display = 'none';
    document.querySelector('.faq-section').style.display = 'none';
} 


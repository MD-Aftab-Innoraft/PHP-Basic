/* Assuming every input field is correctly filled. */
let errorFree = true;

/**
 * Function to check for valid names and return
 * relevant Error message.
 * @params : (i)   string 'data' to be verified.
 *           (ii)  string 'regex' to validate 'data'.
 *           (iii) string 'field' conatins the field being verified.        
 * 
 * @returns : string
 */
function checkInput(data, regex, field) {
    let length = data.length;
    if (length === 0) {
        errorFree = false;
        return `${field} is required.`;
    }
    else if (length < 2 || length > 25 ) {
        errorFree = false;
        return `${field} should be between 2 to 25 characters.`;
    }
    else if (!regex.test(data)) {
        errorFree = false;
        return "* Only alphabets, white-spaces and ' allowed.";
    }
    else {
        return "*";
    }
}

/**
 * Function to implement front-end validation
 * of the user inputs.
 * @params : No input parameters 
 * @returns : boolean (true if no errors)
 */
function validateData() {
    /* Getting the value of the different user inputs */
    let fname = document.getElementById('fname').value.trim();
    let lname = document.getElementById('lname').value.trim();
    let fullName = document.getElementById('fullName').value.trim();
    errorFree = true;

    /* Regex to check for valid names */
    let nameRegex = /^[a-zA-Z\s']+$/;

    /* Validation for First name */
    let fnameError = document.getElementById('fnameError');
    fnameError.innerHTML = checkInput(fname, nameRegex, "First name");

    /* Validation for Last name */
    let lnameError = document.getElementById('lnameError');
    lnameError.innerHTML = checkInput(lname, nameRegex, "Last name");

    /* Returning whether all the input fields are proper
       and the form can be submitted or not. */
    return errorFree;
}

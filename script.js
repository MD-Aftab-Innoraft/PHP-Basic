/* Assuming every input field is correctly filled. */
let errorFree = true;

/**
 * Function to check for valid names and return
 * relevant Error message.
 * @params : (i)   string 'data' to be verified.
 *          (ii)  string 'regex' to validate 'data'.
 *          (iii) string 'field' conatins the field being verified.        
 * 
 * @returns : string stating a relevant error (if any).
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
* Function to check if the input 'data' is a number.
* @params : (i) 'data' to be verified.   
*
* @returns : boolean (true if 'data' is a number. otherwise false).
*/

function isNumber(data) { 
    return /^-?[\d.]+(?:e-?\d+)?$/.test(data); 
} 

/**
* Function to check if the input 'data' has valid 'Subject|Marks' pairs.
* @params : (i)   string 'data' to be verified.   
*           (ii)  string 'regex' to allow only specified characters.
*
* @returns : string containing relevant error message(if any).
*/

function checkSubjectMarks (data, regex){
    if(data.length == 0) {
        errorFree = false;
        return "* No subject|marks pairs entered";
    }
    else if (!regex.test(data)) {
        errorFree = false;
        return "* Only alphabets, digits and | allowed";
    }
    else{
        let lines = data.split("\n");
        let numberOfLines = lines.length;
        for(i = 0; i < numberOfLines; i++){
            subjectMarksPair = lines[i].split("|");
            if(subjectMarksPair.length !== 2 || isNumber(subjectMarksPair[0]) || !isNumber(subjectMarksPair[1])) {
                errorFree = false;
                return "* Invalid Pairs";
            }
            else if(subjectMarksPair[1] > 100 ) {
                errorFree = false;
                return "* Marks cannot be greater than 100";
            }
        }
       
    }
    return "*";
}

/**
*   Function to check if the input Phone number is
*   a valid Indian phone number.
*   @params : (i)  string 'indianPhone' to be verified.
*             (ii) string 'indianPhoneRegex' to be validated against.
*   @returns : string containing relevant error message(if any).
*   */ 

function indianPhoneCheck (indianPhone, indianPhoneRegex) {
    
    if(indianPhone.length != 13) {
        errorFree = false;
        return "* Please input +91 followed by your 10 digit number";
    }
    else if (!indianPhone.startsWith("+91")) {
        errorFree = false;
        return "* Please start with +91";
    }
    else if (!indianPhoneRegex.test(indianPhone)){
        errorFree = false;
        return "* Only digits and + symbol allowed";
    }
    else {
        return "*"; 
    }
}

/**
 * Function to validate Email Address.
 * @params : (i)  string 'emailAddress' to be verified.
 *           (ii) string 'emailAddressRegex' to be validated against.
 * @returns: string stating a relevant error (if any).
 */

function checkEmailAddress(emailAddress, emailAddressRegex) {
    if(emailAddress.length == 0) {
        errorFree = false;
        return "* Email address is required.";
    }
    else if (!emailAddressRegex.test(emailAddress)) {
        errorFree = false;
        return "* Invalid Email address.";
    }
    else {
        return "*";
    }
}

/**
 * Function to implement front-end validation
 * of the user inputs.
 * @params : No input parameters 
 * @returns : boolean (true if no errors).
 */

function validateData() {
    /* Getting the value of the different user inputs */
    let fname = document.getElementById('fname').value.trim();
    let lname = document.getElementById('lname').value.trim();
    let fullName = document.getElementById('fullName').value.trim();
    errorFree = true;

    /* Regex to check for valid names */
    let nameRegex = /^[a-zA-Z\s']+$/;
    let subjectMarksRegex = /^[a-zA-Z0-9|\s]+$/;
    let indianPhoneRegex = /^(\+91)[1-9][0-9]{9}$/;
    let emailAddressRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    /* Validation for First name */
    let fnameError = document.getElementById('fnameError');
    fnameError.innerHTML = checkInput(fname, nameRegex, "First name");

    /* Validation for Last name */
    let lnameError = document.getElementById('lnameError');
    lnameError.innerHTML = checkInput(lname, nameRegex, "Last name");

    /* Validation for 'Subject|Marks' pairs. */
    let subjectMarks = document.getElementById("subjectMarks").value.trim();
    let subjectMarksError = document.getElementById("subjectMarksError");
    subjectMarksError.innerHTML = checkSubjectMarks(subjectMarks, subjectMarksRegex);

    /* Validation of Indian Phone number. */
    let indianPhoneNumber = document.getElementById('indianPhoneNumber').value.toString().trim();
    let indianPhoneError = document.getElementById('indianPhoneError');
    indianPhoneError.innerHTML = indianPhoneCheck(indianPhoneNumber, indianPhoneRegex);

    let emailAddress = document.getElementById('emailAddress').value.trim();
    let emailAddressError = document.getElementById('emailAddressError');
    emailAddressError.innerHTML = checkEmailAddress(emailAddress, emailAddressRegex);

    /* Returning whether all the input fields are proper
       and the form can be submitted or not. */
    return errorFree;
}


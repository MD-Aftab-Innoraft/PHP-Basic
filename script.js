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
* Function to check if the input 'data' is a number.
* @params : (i) 'data' to be verified.   
*
* @returns : boolean (true if 'data' is a number. otherwise false)
*/

function isNumber(data) { 
    return /^-?[\d.]+(?:e-?\d+)?$/.test(data); 
} 

/**
* Function to check if the input 'data' has valid 'Subject|Marks' pairs.
* @params : (i)   string 'data' to be verified.   
*           (ii)  string 'regex' to allow only specified characters.
*
* @returns : string containing the Error message(if any).
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
 * Function to implement front-end validation
 * of the user inputs.
 * @params : No input parameters 
 * @returns : boolean (true if no errors).
 */

function validateData() {
    alert("Script is running");
    /* Getting the value of the different user inputs */
    let fname = document.getElementById('fname').value.trim();
    let lname = document.getElementById('lname').value.trim();
    let fullName = document.getElementById('fullName').value.trim();
    errorFree = true;

    /* Regex to check for valid names */
    let nameRegex = /^[a-zA-Z\s']+$/;
    let subjectMarksRegex = /^[a-zA-Z0-9|\s]+$/;

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


    /* Returning whether all the input fields are proper
       and the form can be submitted or not. */
    return errorFree;
}


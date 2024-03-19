/* Assuming every input field is correctly filled. */
let errorFree = true;

/**
 * Validates name fieldsn and find relevant errors.
 *
 * @params string data
 *  Data to be verified.
 * @param string regex
 *  Regex to be validated against.
 * @param string field
 *  Field name which is being verified.
 *
 *  @return string
 *  Stating relevant error message.
 */

function checkInput(data, regex, field) {
  let length = data.length;
  if (length === 0) {
    // No data is entered.
    errorFree = false;
    return `${field} is required.`;
  }
  else if (length < 2 || length > 25 ) {
    // Input data is not within specified length.
    errorFree = false;
    return `${field} should be between 2 to 25 characters.`;
  }
  else if (!regex.test(data)) {
    // Input contains any forbidden characters.
    errorFree = false;
    return "* Only alphabets and white-spaces ";
  }
  return "*";
}

/**
 * Function to check if the input 'data' is a number.
 * @param string data
 *  Data to be checked.
 *
 * @return bool
 * true if data is a number, otherwise false.
 */
function isNumber(data) {
    return /^-?[\d.]+(?:e-?\d+)?$/.test(data);
}

/**
 * Function to check if the input 'data' has valid 'Subject|Marks' pairs.
 * @param string data
 *  Data to be verified.
 * @param string regex
 *  Regex to be validated against.
 *
 * @return string
 *  Containing the error message(if any).
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
      /* Trim any extra spaces in subject and marks. */
      let subject = subjectMarksPair[0].trim();
      let marks = subjectMarksPair[1].trim();
      if (subjectMarksPair.length !== 2 || isNumber(subject) || !isNumber(marks)) {
        /* More than one pair in a line, subject is numeric or marks is not numeric. */
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
 *
 * @return  bool
 *  true if every field is properly filled, false otherwise.
 */
function validateData() {
  /* Getting the value of the different user inputs */
  let fname = document.getElementById('fname').value.trim();
  let lname = document.getElementById('lname').value.trim();
  errorFree = true;

  /* Regex to check for valid names */
  let nameRegex = /^[a-zA-Z\s]+$/;
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

  // Returning whether all the input fields are properly filled
  // and the form can be submitted or not.
  return errorFree;
}

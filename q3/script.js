// Regex to check for valid names.
const NAMEREGEX = /^[a-zA-Z\s]+$/;
// Regex to validate Subject|Marks pairs.
const SUBJECTMARKSREGEX = /^[a-zA-Z0-9|\s]+$/;

// Assuming every input field is correctly filled.
let errorFree = true;

/**
 * Function to redirect to different pages based on clicked button.
 *
 * @param {int} num
 *  Question number to be redirected to
 */
function handleQueryClick(num) {
  window.location.href = `../q${num}/`;
}

/**
 * Validates name fields and find relevant errors.
 *
 * @param {string} data
 *  Data to be verified.
 * @param {string} regex
 *  Regex to be validated against.
 * @param {string} field
 *  Field name which is being verified.
 *
 *  @return {string}
 *  Stating relevant error message.
 */
function checkInput(data, regex, field) {
  let length = data.length;
  if (length === 0) {
    // No data is entered.
    errorFree = false;
    return `${field} is required.`;
  }
  else if (length < 2 || length > 25) {
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
 *
 * @param {string} data
 *  Data to be checked.
 *
 * @return {bool}
 * true if data is a number, otherwise false.
 */
function isNumber(data) {
  return /^-?[\d.]+(?:e-?\d+)?$/.test(data);
}

/**
 * Function to check if the input 'data' has valid 'Subject|Marks' pairs.
 *
 * @param {string} data
 *  Data to be verified.
 * @param {string} regex
 *  Regex to be validated against.
 *
 * @return {string}
 *  Containing the error message(if any).
 */
function checkSubjectMarks(data, regex) {
  // No user input.
  if (data.length == 0) {
    errorFree = false;
    return "* No subject|marks pairs entered";
  }
  // Contains invalid character(s).
  else if (!regex.test(data)) {
    errorFree = false;
    return "* Only alphabets, digits and | allowed";
  }
  else {
    // Splitting using new line.
    let lines = data.split("\n");
    let numberOfLines = lines.length;
    for (i = 0; i < numberOfLines; i++) {
      subjectMarksPair = lines[i].split("|");
      // Trim any extra spaces in subject and marks.
      let subject = subjectMarksPair[0].trim();
      let marks = subjectMarksPair[1].trim();
      // More than one pair in a line, subject is numeric or marks is not numeric.
      if (subjectMarksPair.length !== 2 || isNumber(subject) || !isNumber(marks)) {
        errorFree = false;
        return "* Invalid Pairs";
      }
      // Marks in a pair is greater than 100.
      else if (subjectMarksPair[1] > 100) {
        errorFree = false;
        return "* Marks cannot be greater than 100";
      }
    }
  }
  // No error.
  return "*";
}

/**
 * Function to implement front-end validation
 * of the user inputs.
 *
 * @return  {bool}
 *  true if every field is properly filled, false otherwise.
 */
function validateData() {
  // Getting the value of the different user inputs.
  let fname = document.getElementById('fname').value.trim();
  let lname = document.getElementById('lname').value.trim();
  errorFree = true;

  // Validation for First name.
  let fnameError = document.getElementById('fnameError');
  fnameError.innerHTML = checkInput(fname, NAMEREGEX, "First name");

  // Validation for Last name.
  let lnameError = document.getElementById('lnameError');
  lnameError.innerHTML = checkInput(lname, NAMEREGEX, "Last name");

  // Validation for 'Subject|Marks' pairs.
  let subjectMarks = document.getElementById("subjectMarks").value.trim();
  let subjectMarksError = document.getElementById("subjectMarksError");
  subjectMarksError.innerHTML = checkSubjectMarks(subjectMarks, SUBJECTMARKSREGEX);

  // Return whether all input fields are properly filled.
  return errorFree;
}

// Regex to check for valid names.
const NAMEREGEX = /^[a-zA-Z\s]+$/;
// Regex to validate Subject|Marks pairs.
const SUBJECTMARKSREGEX = /^[a-zA-Z0-9|\s]+$/;
// Regex to validate an Indian phone number.
const INDIANPHONEREGEX = /^(\+91)[1-9][0-9]{9}$/;
// Regex to validate email address.
const EMAILADDRESSREGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Assuming every input field is correctly filled.
let errorFree = true;

/**
 * Function to redirect to different pages based on clicked button.
 *
 * @param int num
 *  Question number to be redirected to
 */
function handleQueryClick(num) {
  window.location.href = `../q${num}/`;
}

/**
 * Function to check for valid names and return relevant error message.
 *
 * @param {string} data
 *  Data to be verified.
 * @param {string} regex
 *  Regex to be validated against.
 * @param {string} field.
 *  Field name which is being verified.
 *
 * @return {string}
 *  Stating relevant error message.
 */
function checkInput(data, regex, field) {
  let length = data.length;
  // No user input.
  if (length === 0) {
    errorFree = false;
    return `${field} is required.`;
  }
  // Input length is not within specified limits.
  else if (length < 2 || length > 25) {
    errorFree = false;
    return `${field} should be between 2 to 25 characters.`;
  }
  // Contains invalid character(s).
  else if (!regex.test(data)) {
    errorFree = false;
    return "* Only alphabets, white-spaces and ' allowed.";
  }
  // No error.
  return "*";
}

/**
 * Function to check if the input 'data' is a number.
 *
 * @param {string} data
 *  Data to be verified.
 *
 * @return {bool}
 *  true if 'data' is a number, false otherwise.
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
 *  Stating relevant error message.
 */
function checkSubjectMarks(data, regex) {
  // No data input by user.
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
      // More than one pair in a line, subject is numeric or marks is not numeric.
      if (subjectMarksPair.length !== 2 || isNumber(subjectMarksPair[0]) || !isNumber(subjectMarksPair[1])) {
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
 * Function to check for Indian Phone number.
 *
 * @param {string} indianPhone
 *  Phone number to be verified.
 * @param {string} indianPhoneRegex
 *  Regex to be validated against.
 *
 * @return {string}
 *  Containing relevant error message(if any).
 */
function indianPhoneCheck(indianPhone, indianPhoneRegex) {
  // Phone number is not of desired length.
  if (indianPhone.length != 13) {
    errorFree = false;
    return "* Please input +91 followed by your 10 digit number";
  }
  // Phone number doesn't start with "+91";
  else if (!indianPhone.startsWith("+91")) {
    errorFree = false;
    return "* Please start with +91";
  }
  // Contains invalid character(s).
  else if (!indianPhoneRegex.test(indianPhone)) {
    errorFree = false;
    return "* Only digits and + symbol allowed";
  }
  // No error.
  return "*";
}

/**
 * Function to validate Email Address.
 *
 * @param {string} emailAddress
 *  Email address to be verified.
 * @param {string} emailAddressRegex
 *  Regex to be validated against.
 *
 * @return {string}
 *  Stating a relevant error (if any).
 */
function checkEmailAddress(emailAddress, emailAddressRegex) {
  // No user input.
  if (emailAddress.length == 0) {
    errorFree = false;
    return "* Email address is required.";
  }
  // Does not match email naming convention.
  else if (!emailAddressRegex.test(emailAddress)) {
    errorFree = false;
    return "* Invalid Email address.";
  }
  // No error.
  return "*";
}

/**
 * Function to implement front-end validation of user inputs.
 *
 * @return {bool}
 *  true if no errors, false otherwise.
 */
function validateData() {
  // Initially, assuming every field is properly filled.
  errorFree = true;

  // Getting the value of the different user inputs.
  let fname = document.getElementById('fname').value.trim();
  let lname = document.getElementById('lname').value.trim();
  let fullName = document.getElementById('fullName').value.trim();

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

  // Validation of Indian Phone number.
  let indianPhoneNumber = document.getElementById('indianPhoneNumber').value.toString().trim();
  let indianPhoneError = document.getElementById('indianPhoneError');
  indianPhoneError.innerHTML = indianPhoneCheck(indianPhoneNumber, INDIANPHONEREGEX);

  // Validation of Email address.
  let emailAddress = document.getElementById('emailAddress').value.trim();
  let emailAddressError = document.getElementById('emailAddressError');
  emailAddressError.innerHTML = checkEmailAddress(emailAddress, EMAILADDRESSREGEX);

  // Return whether all input fields are properly filled.
  return errorFree;
}

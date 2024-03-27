// Regex to verify names.
const NAMEREGEX = /^[a-zA-Z\s]+$/;

// Initially assuming there are no errors.
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
 *
 * @param {string} data
 *  Data to be validated.
 *
 * @param {string} regex
 *  Regex to be validated against.
 *
 * @param {string} field
 *  Field for which validation is performed.
 *
 * @return {string}
 *  Relevant error message.
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
    return "* Only alphabets and white-spaces allowed.";
  }
  // No error.
  return "*";
}

/**
 * Function to verify the user input data.
 */
function validateData() {
  errorFree = true;

  // Getting the first name and it's error using their id.
  let fname = document.getElementById('fname').value.trim();
  let fnameError = document.getElementById('fnameError');

  // Getting the last name and it's error msg using their id.
  let lname = document.getElementById('lname').value.trim();
  let lnameError = document.getElementById('lnameError');

  // Validation for First name and display errors.
  fnameError.innerHTML = checkInput(fname, NAMEREGEX, "First name");

  // Validation for Last name and display errors.
  lnameError.innerHTML = checkInput(lname, NAMEREGEX, "Last name");

  // Returning if there are any errors or not.
  return errorFree;
}

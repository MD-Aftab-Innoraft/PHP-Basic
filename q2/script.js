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
 * Function to check for valid names and return
 * relevant Error message.
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
    errorFree = false;
    return `${field} is required.`;
  }
  else if (length < 2 || length > 25) {
    errorFree = false;
    return `${field} should be between 2 to 25 characters.`;
  }
  else if (!regex.test(data)) {
    errorFree = false;
    return "* Only alphabets and white-spaces allowed.";
  }
  return "*";
}

/**
 * Function to implement front-end validation of user inputs.
 *
 * @return {bool}
 *  true if every field is properly filled, false otherwise.
 */
function validateData() {
  // Getting the value of first and last name.
  let fname = document.getElementById('fname').value.trim();
  let lname = document.getElementById('lname').value.trim();

  // Initially, asssume the fields to be properly field.
  errorFree = true;

  // Regex to check for valid names.
  const NAMEREGEX = /^[a-zA-Z\s]+$/;

  // Validation for first name.
  let fnameError = document.getElementById('fnameError');
  fnameError.innerHTML = checkInput(fname, NAMEREGEX, "First name");

  // Validation for last name.
  let lnameError = document.getElementById('lnameError');
  lnameError.innerHTML = checkInput(lname, NAMEREGEX, "Last name");

  // Return whether all fields are properly filled.
  return errorFree;
}

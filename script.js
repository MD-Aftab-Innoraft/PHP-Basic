/* Assuming every input field is correctly filled. */
let errorFree = true;

/**
 * Function to check for valid names and return
 * relevant Error message.
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
    errorFree = false;
    return `${field} is required.`;
  }
  else if (length < 2 || length > 25 ) {
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
 * Function to implement front-end validation
 * of the user inputs.
 *
 * @return bool
 *  true if every field is properly filled, false otherwise.
 */
function validateData() {
  // Getting the value of first and last name.
  let fname = document.getElementById('fname').value.trim();
  let lname = document.getElementById('lname').value.trim();

  // Initially, asssume the fields to be properly field.
  errorFree = true;

  // Regex to check for valid names.
  let nameRegex = /^[a-zA-Z\s]+$/;

  // Validation for first name.
  let fnameError = document.getElementById('fnameError');
  fnameError.innerHTML = checkInput(fname, nameRegex, "First name");

  // Validation for last name.
  let lnameError = document.getElementById('lnameError');
  lnameError.innerHTML = checkInput(lname, nameRegex, "Last name");

  /* Returning whether all the input fields are proper
     and the form can be submitted or not. */
  return errorFree;
}

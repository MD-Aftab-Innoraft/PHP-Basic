let errorFree = true;

function checkInput(data, regex, field) {
  let length = data.length;
  if (length === 0) {
    errorFree = false;
    return `${field} is required.`;
  }
  else if (length < 2 || length > 50) {
    errorFree = false;
    return `${field} should be between 2 to 50 characters.`;
  }
  else if (!regex.test(data)) {
    errorFree = false;
    return "* Only alphabets, white-spaces and ' allowed.";
  }
  else {
    return "*";
  }
}

function validateData() {
  errorFree = true;
  /* Getting the first name and it's error using their id. */
  let fname = document.getElementById('fname').value.trim();
  let fnameError = document.getElementById('fnameError');

  /* Getting the last name and it's error msg using their id. */
  let lname = document.getElementById('lname').value.trim();
  let lnameError = document.getElementById('lnameError');

  /* Regex to verify names. */
  let nameRegex = /^[a-zA-Z\s']+$/;

  /* Validation for First name and display errors. */
  fnameError.innerHTML = checkInput(fname, nameRegex, "First name");

  /* Validation for Last name and display errors. */
  lnameError.innerHTML = checkInput(lname, nameRegex, "Last name");

  /* Returning if there are any errors or not. */
  return errorFree;
}

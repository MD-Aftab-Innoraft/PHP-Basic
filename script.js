
function dataValidate() {

    /* Assuming the input email address is valid. */
    let errorFree = true;

    /* Regex to validate email address. */
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    /* Getting the user entered Email address. */
    let email = document.getElementById('email').value.trim();
    let emailError = document.getElementById('emailError');

    /* Checking for errors if any. */
    if (email == "") {
        alert("in empty field");
        errorFree = false;
        emailError.innerHTML = "* Email address is required";
    }
    else if (!emailRegex.test(email)) {
        errorFree = false;
        emailError.innerHTML = "* Invalid email!";
    }
    else {
        emailError.innerHTML = "*";
    }

    /* Returns true if there email id is valid, false otherwise. */
    return errorFree;
}


function dataValidate() {

    let errorFree = true;

    /* Getting the user entered Email address. */
    let email = document.getElementById('email').value.trim();
    let emailError = document.getElementById('emailError');

    /* Checking for errors if any. */
    if (email == "") {
        errorFree = false;
        emailError.innerHTML = "* Email address is required";
    }
    else if (filter_var(email, FILTER_VALIDATE_EMAIL)) {
        alert("filter validate email part");
        errorFree = false;
        emailError.innerHTML = "* Invalid email!";
    }
    else {
        emailError.innerHTML = "*";
    }

    return errorFree;
}

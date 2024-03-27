function validateData() {

  let errorFree = true;
  let uname = document.getElementById('uname').value.trim();
  let pwd = document.getElementById('pwd').value.trim();

  let unameError = document.getElementById('unameError');
  if(uname == "") {
    errorFree = false;
    unameError.innerHTML = "* Username is required";
    }
  else {
    unameError.innerHTML = "*";
  }

  let pwdError = document.getElementById('pwdError');
  if (pwd == "") {
    errorFree = false;
    pwdError.innerHTML = "* Password is required";
  }
  else {
    pwdError.innerHTML = "*";
  }

  return errorFree;
}


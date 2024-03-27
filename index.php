<?php
// Login credentials.
$myUser = "aftab";
$myPwd = "1234";
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Getting username and password from $_POST[] superglobal.
  $username = $_POST['uname'];
  $password = $_POST['pwd'];

  // Verifying username and password.
  if (($myUser == $username) && ($myPwd == $password)) {
    session_start();
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $username;
    header("location:../q1/");
  }
  else {
    $loginError = "* Wrong username or password!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./stylesheets/style.css">
</head>
<body>
  <div class="container">
    <h1>Login to your account:-</h1>
    <span class="error"><?php echo $loginError; ?></span>

    <form onsubmit="return validateData();" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <!-- Input for username and display related errors. -->
    <label for="uname">Username:</label>
    <input type="text" name="uname" id="uname" maxlength="50">
    <span class="error" id="unameError">*</span>

    <!-- Input for password and display related errors. -->
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd" maxlenght="50">
    <span class="error" id="pwdError">*</span>

    <input type="submit" value="submit" id="submit">
  </div>
</form>
<script src="./scripts/script.js"></script>
</body>
</html>

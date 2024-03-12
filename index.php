<?php

$myUser = "aftab";
$myPwd = "1234";
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Getting username and password from $_POST[] superglobal. */
    $username = $_POST['uname'];
    $password = $_POST['pwd'];

    /* Verifying username and password. */
    if (($myUser == $username) && ($myPwd == $password)) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        header("location: q1.php");
    }
    else {
        $loginError = "* Invalid Credentials.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
        }

        .container {
            width: 800px;
            margin: auto;
        }

        .error{
            color:red;
            vertical-align: top;
        }
        
        label{
            display: block;
            font-size: 25px;
            margin-top: 30px;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            margin: auto;
            font-size: 20px;
            padding: 5px 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            border: 1px solid black;
            outline: none;
        }

        input[type="submit"] {
            display: block;
            font-size: 20px;
            padding: 5px 15px;
            margin-top: 30px;
        }

        input[type="submit"]:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Login to your account:-</h1>
    <span><?php echo $loginError; ?></span>

    <form onsubmit="return validateData();" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <label for="uname">Username:</label>
    <input type="text" name="uname" id="uname" maxlength="50">
    <span class="error" id="unameError">*</span>

    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd" maxlenght="50">
    <span class="error" id="pwdError">*</span>

    <input type="submit" value="submit" id="submit">
</form>

<script>
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
</script>
</body>
</html>
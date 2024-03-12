
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send email</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

    <h1>Enter your contact information:</h1>
    <form onsubmit="return dataValidate();" action="send.php" method="post">
        
        <!-- Email address to send mail to. -->
        <label for="email">Email Address: </label>
        <input type="email" name="email" id="email" maxlength="100">
        <span class="error" id="emailError">*</span> <br>

        <!-- Submits the form. -->
        <button type="submit" name="send">Send</button>
    </form>

    </div>
    
    <!-- Linking the javascript file. -->
    <script src="./script.js"></script>
</body>
</html>


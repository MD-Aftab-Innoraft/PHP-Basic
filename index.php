<?php
session_start();

$fname = $lname = $fullname = "";
$fnameErr = $lnameErr = "";
$helloMsg = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
        $fnameErr = "First Name is required";
    } else {
        $fname = $_POST["fname"];
        // Check if name contains only alphabets and white-sapces
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white-spaces allowed";
            echo "";
        }
    }



    if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = $_POST["lname"];
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white-spaces allowed";
        }
    }

    if($fnameErr == "" && $lnameErr == "") {
        $helloMsg = "Hello " . $fname . " " . $lname;
    }

    // saving the POST variables as session variables(if required to access different pages within the same domain)
    // Note: not used in this assignment
    if ($fnameErr == "" && $lnameErr == "") {
        $_SESSION["fname"] = $_POST["fname"];
        $_SESSION["lname"] = $_POST["lname"];

        $fullname = $_SESSION["fname"] . " " . $_SESSION["lname"];

        $_SESSION["fullname"] = $fullname;

        // if we need the output in a different page after clicking the "submit" button
        // header("Location: http://php-basic.com/output.php");
    }
}

// function to sanitize the input data
function test_input($data)
{
    $data = trim($data);                // removing the extra left and right spaces
    $data = stripslashes($data);        // removing the slashes(if present in input)(nog required for the problem statement)
    $data = htmlspecialchars($data);    // converts special chars to  HTML entities
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment - 1</title>
    <!-- linking the stylesheet for this page  -->
    <link rel="stylesheet" href="./formstyle.css">
</head>

<body>
    <h1 class="heading">PHP Assignment 1</h1>

        <p class="requiredInstruct"><span class="error">* required field</span></p>

        <div class="container">

            <!-- form which takes firstname and lastname as input from user and fullname is disabled -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname" placeholder="<?php echo ($fname == "" ? 'Your First Name here':'');?>">
                <span class="error">* <?php echo $fnameErr ?></span><br>

                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname" placeholder="<?php echo ($lname == "" ? 'Your Last Name here':'');?>">
                <span class="error">* <?php echo $lnameErr ?></span><br>

                <label for="fullname">Full Name:</label><br>
                <input type="text" id="fullname"  name="fullname" value="<?php echo (($fnameErr == "" && $lnameErr == "") ? "$fname $lname": "");?>" disabled> <br>

                <input type="submit" value="submit" id="submit">
            </form>
            
            <h2 class="helloMsg"><?php echo $helloMsg; ?></h2>
        </div>

</body>

</html>


 
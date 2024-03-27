<?php

// If user is not logged in, he is redirected to login page.
session_start();
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
  header("location:../index.php");
}

// Adding the use of query string to traverse different pages.
if($_SERVER["REQUEST_METHOD"] == "GET") {
  if(!empty($_GET['q'])) {
    $num = $_GET['q'];
    if($num > 0 && $num < 7) {
      header("location:../q$num/");
    }
  }
}

// Regex to validate names.
const NAMEREGEX = "/^[a-zA-Z ]*$/";

// Declaring global variables and initializing to empty string.
/**
 * @var string
 *  Stores the First name.
 */
$fname = "";

/**
 * @var string
 *  Stores the First name.
 */
$lname = "";

/**
 * @var string
 *  Stores the First name.
 */
$fullname = "";

/**
 * @var string
 *  Error msg for first name.
 */
$fnameErr = "";

/**
 * @var string
 *  Error msg for first name.
 */
$lnameErr = "";

/**
 * @var string
 *  Hello message for the user.
 */
$helloMsg = "";

/**
 * Verifies the validity of first and last names.
 *
 * @param string $data
 *  Data to be validated.
 *
 * @param string $regex
 *  Regex to be validated against.
 *
 * @param string $field.
 *  Field name which is being verified.
 *
 * @param string &$fieldErr
 *  Error variable to be updated.
 */
function validateField(string $data, string $regex, string $field, string &$fieldErr): void {
  // Trimming the unnecessary spaces.
  $data = trim($data, " \t\n\r\0\x0B");

  // If input data is empty.
  if(empty($data)) {
    $fieldErr = "$field is required.";
  }
  elseif (strlen($data) < 2 || strlen($data) > 25) {
    // Data is not within the specified length.
    $fieldErr = "$field must be between 2 and 25 characters.";
  }
  elseif (!preg_match($regex, $data)) {
    // Validating data against a regex.
    $fieldErr = "* Only alphabets and white-spaces allowed.";
  }
}

// When the form is submitted using POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Getting first and last names from $_POST.
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];

  // Validating first and last names.
  validateField($fname, NAMEREGEX, "First name", $fnameErr);
  validateField($lname, NAMEREGEX, "Last name", $lnameErr);

  // Hello msg created if first and last name are proper.
  if ($fnameErr == "" && $lnameErr == "") {
    $helloMsg = "Hello " . $fname . " " . $lname;
  }
}

/**
 * Perform basic string sanitizatons like
 * trimming extra spaces, removing slashes and
 * converting special characters to HTML entities.
 *
 * @param string $data
 *  Data to be sanitized.
 *
 * @return string
 *  Sanitized string data.
 */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment - 1</title>
  <!-- Linking the stylesheet for the page.  -->
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
    <h1 class="heading">PHP Assignment 1</h1>
    <p class="requiredInstruct"><span class="error">* required field</span></p>
    <p class="logoutBtn"><a href="../logout.php">Logout</a></p>

    <!-- Form to take user inputs. -->
    <form method="post" onsubmit="return validateData();"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

      <!-- Input for first name and display related errors. -->
      <label for="fname">First name:</label><br>
      <input type="text" id="fname" name="fname" maxlength="25"
      placeholder="<?php echo ($fname == "" ? 'Your First Name here':'');?>">
      <span class="error" id="fnameError">*<?php echo $fnameErr ?></span> <br>

      <!-- Input for last name and display related errors. -->
      <label for="lname">Last name:</label><br>
      <input type="text" id="lname" name="lname" maxlength="25"
      placeholder="<?php echo ($lname == "" ? 'Your Last Name here':'');?>">
      <span class="error" id="lnameError">*<?php echo $lnameErr ?></span> <br>

      <!-- Disabled input field to display full name. -->
      <label for="fullname">Full Name:</label><br>
      <input type="text" id="fullname"  name="fullname" disabled maxlength="50"
      value="<?php echo (($fnameErr == "" && $lnameErr == "") ? "$fname $lname": "");?>"> <br>

      <!-- Submit button for the form. -->
      <input type="submit" value="submit" id="submit">
    </form>
    <?php require ('../components/pageBtns.html'); ?>
    <!-- Hello msg for the user. -->
    <h2 class="helloMsg"><?php echo $helloMsg; ?></h2>
  </div>
  <!-- Linked the script file for the page. -->
  <script src="script.js"></script>
</body>
</html>

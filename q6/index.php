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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assign-6</title>

  <!-- Linking stylesheet for the page. -->
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="container">
  <p class="logoutBtn"><a href="../logout.php">Logout</a></p>
    <h1 class="heading">PHP Assignment 6</h1>
    <!-- Form is submitted if no errors are found by javascript. -->
    <form onsubmit="return validateData();" method="post" enctype="multipart/form-data" action="pdfGenerate.php">

      <!-- Input First name and display related errors (if any). -->
      <label for="fname">First Name: </label>
      <input type="text" name="fname" id="fname" minlength="2" maxlength="25" required placeholder="Enter your First Name">
      <span class="error" id="fnameError">*</span> <br>

      <!-- Input Last name and display related errors (if any). -->
      <label for="lname">Last Name: </label>
      <input type="text" name="lname" id="lname" minlength="2" maxlength="25" required placeholder="Enter your Last Name">
      <span class="error" id="lnameError">*</span> <br>

      <!-- Full name disabled field for displaying it and related errors. -->
      <label for="lname">Full Name: </label>
      <input type="text" name="fullName" id="fullName" value="" maxlimit="50" disabled>
      <span class="error" id="fullNameError">*</span> <br>

      <!-- Uploading an image and display related errors if any). -->
      <label for="image">Upload your image</label>
      <input accept="image/apng, image/jpeg, image/png" name="image" id="image" required type="file" title="Please upload an image" />
      <span class="error" id="imageError">*</span><br>

      <!-- Input for Subject|Marks pairs. One in each line and show errors. -->
      <label for="subjectMarks">Enter Subject|Marks : </label>
      <textarea name="subjectMarks" id="subjectMarks" cols="30" rows="10" required maxlength="100"></textarea>
      <span class="error" id="subjectMarksError">*</span> <br>

      <!-- Input an Indian Phone number and display related errors. -->
      <label for="indianPhoneNumber" id="indianPhoneNumberLabel">Indian Phone no. :</label>
      <input type="tel" name="indianPhoneNumber" id="indianPhoneNumber" placeholder="Enter +91 followed by 10 digit number" minlength="13" maxlength="13" required>
      <span class="error" id="indianPhoneError">*</span> <br>

      <!-- Input email address and display related errors (if any). -->
      <label for="emailAddress">Email Address:</label>
      <input type="email" name="emailAddress" id="emailAddress" placeholder="Enter your Email address" maxlength="100" required>
      <span class="error" id="emailAddressError">*</span> <br>

      <!-- Submits the form. -->
      <input type="submit" name="submit" value="Submit">
    </form>
    <?php

    // Buttons for traversing different pages.
    require ('../components/pageBtns.html');

    ?>
  </div>

  <!-- Adding the javascript file. -->
  <script src="./script.js"></script>
</body>
</html>

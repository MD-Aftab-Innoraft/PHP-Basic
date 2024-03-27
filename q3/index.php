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

// Regex to check for valid names.
const NAMEREGEX = '/^[a-zA-Z\s]+$/';

// Regex to validate Subject|Marks pairs.
const SUBJECTMARKSREGEX = '/^[a-zA-Z0-9|\s\n ]+$/';

// Importing the Form Class file.
require 'Form.php';

// Creating a new Form object.
$myForm = new Form();

// When the form is submitted using POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Getting user input of first and last names.
  $fname = Form::testInput($_POST["fname"]);
  $lname = Form::testInput($_POST["lname"]);

  // Setting first name if user input is valid.
  $myForm->fnameError = $myForm->checkInput($fname, NAMEREGEX);
  if ($myForm->fnameError == "") {
    $myForm->setFirstName($fname);
  }

  // Setting last name if user input is valid.
  $myForm->lnameError = $myForm->checkInput($lname, NAMEREGEX);
  if ($myForm->lnameError == "") {
    $myForm->setLastName($lname);
  }

  // Setting Full name if both First and Last names are valid.
  if ($myForm->fnameError == "" && $myForm->lnameError == "") {
    $myForm->setFullname();
  }

  // Accepting image and saving it in the 'uploads' folder.
  $img_name = $_FILES['image']['name'];
  $img_tmp = $_FILES['image']['tmp_name'];
  // Move $img_tmp to the required folder with the name with which it is saved.
  move_uploaded_file($img_tmp, "../uploads/$img_name");

  // Extracting the Subject|Marks pairs from $_POST.
  $subjectMarks = $_POST["subjectMarks"];
  // Finding any errors in Subject|Marks pairs.
  $myForm->subjectMarksError = $myForm->checkSubjectMarks($subjectMarks, SUBJECTMARKSREGEX);
  if($myForm->subjectMarksError == "") {
    $myForm->setSubjectMarks($subjectMarks);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assign-2</title>

  <!-- Linking stylesheet for the page. -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <p class="logoutBtn"><a href="../logout.php">Logout</a></p>
    <h1 class="heading">PHP Assignment 3</h1>

    <form onsubmit="return validateData();" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <!-- Input for First name and display for errors. -->
      <label for="fname">First Name: </label>
      <input type="text" name="fname" id="fname" minlength="2" maxlength="25" required placeholder="Enter your First Name">
      <span class="error" id="fnameError">* <?php echo $myForm->fnameError; ?></span><br>

      <!-- Input for Last name and display for errors. -->
      <label for="lname">Last Name: </label>
      <input type="text" name="lname" id="lname" minlength="2" maxlength="25" required placeholder="Enter your Last Name">
      <span class="error" id="lnameError">* <?php echo $myForm->lnameError; ?></span><br>

      <!-- Full name disabled input field for displaying it and related errors. -->
      <label for="lname">Full Name: </label>
      <input type="text" name="fullName" id="fullName" value="<?php echo $myForm->getFullName() ?>"  maxlimit="50" disabled>
      <span class="error" id="fullNameError" >* <?php echo $myForm->fullNameError; ?></span><br>

      <!-- Uploading an image and displaying related errors. -->
      <label for="image">Upload your image</label>
      <input accept="image/apng, image/jpeg, image/png" name="image" id="image" required type="file" title="Please upload an image" />
      <span class="error" id="imageError"> <?php echo $imageUploadError; ?></span><br>

      <!-- Input for Subject|Marks pairs. One in each line. -->
      <label for="subjectMarks">Enter Subject|Marks : </label>
      <textarea name="subjectMarks" id="subjectMarks" cols="30" rows="10" required maxlength="100"></textarea>
      <span class="error" id="subjectMarksError">* <?php echo $myForm->subjectMarksError ?> </span>

      <!-- Submits the form. -->
      <input type="submit" name="submit" value="Submit">
    </form>

    <?php

    // Buttons for traversing different pages.
    require ('../components/pageBtns.html');

    // If the form is submitted and there are no errors in any input field.
    if(isset($_POST["submit"]) && $myForm->checkNoError()) {
      // If the image name is set, we display the image.
      if (isset($img_name)) {?>
        <div class='showimage'>
          <img  src = "../uploads/<?php echo $img_name; ?>" height="250px" >
        </div>
      <?php } ?>

      <!-- Displaying Hello message to the user.  -->
      <div class="detail"><?php echo "Hello, " . $myForm->getFullName(); ?></div>

      <?php
      $mySubjectMarks = $myForm->getSubjectMarks(); ?>
      <!-- Displaying the Subject|Marks pairs in the form of a table.  -->
      <table>
        <!-- Table headers. -->
        <tr>
        <th>Srl no.</th>
        <th>subject</th>
        <th>Marks</th>
      <?php
      $sl = 1;
      $mySubjectMarks = explode("\n",$mySubjectMarks);
      // Getting each pair one by one.
      foreach($mySubjectMarks as $line){
        $parts = explode("|", $line);
        $subject = trim($parts[0], " \t\n\r\0\x0B");
        $marks = trim($parts[1], " \t\n\r\0\x0B");
      ?>
      <!-- Displaying the rows one by one. -->
      <tr>
        <td><?php echo $sl++;?></td>
        <td><?php echo $subject;?></td>
        <td><?php echo $marks;?></td>
      </tr>

      <?php } ?>
      </table>
    <?php } ?>
  </div>

  <!-- Adding the javascript file. -->
  <script src="./script.js"></script>
</body>
</html>

<?php

// Regex to check for valid names.
const NAMEREGEX = '/^[a-zA-Z\s]+$/';
// Regex to validate Subject|Marks pairs.
const SUBJECTMARKSREGEX = '/^[a-zA-Z0-9|\s\n ]+$/';
// Regex to validate Indian Phone number.
const INDIANPHONEREGEX = '/^(\+91)[1-9][0-9]{9}$/';

// Including autoload.php file.
require('../vendor/autoload.php');

// Importing the inputForm Class file.
require 'Form.php';

// Requiring the Fpdf\Fpdf class.
use Fpdf\Fpdf;

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

  // Extracting 'Subject|Marks' pairs and display relevant error message.
  $subjectMarks = $_POST["subjectMarks"];
  $myForm->subjectMarksError = $myForm->checkSubjectMarks($subjectMarks, SUBJECTMARKSREGEX);
  if ($myForm->subjectMarksError == "") {
    $myForm->setSubjectMarks($subjectMarks);
  }

  // Extracting input Phone number and display relevant errors.
  $indianPhoneNumber = $_POST["indianPhoneNumber"];
  $myForm->indianPhoneError = $myForm->indianPhoneCheck($indianPhoneNumber, INDIANPHONEREGEX);
  if ($myForm->indianPhoneError == "") {
    $myForm->setIndianPhoneNumber($indianPhoneNumber);
  }

  // Extracting input email address and display relevant errors.
  $emailAddress = $_POST["emailAddress"];
  $myForm->emailAddressError = $myForm->checkEmailAddress($emailAddress);
  if ($myForm->emailAddressError == "") {
    $myForm->setEmailAddress($emailAddress);
  }
}

// If Form is submitted using POST and no errors present.
if ($_SERVER["REQUEST_METHOD"] == "POST" && $myForm->checkNoError()) {
  // Creating an object of Fpdf class.
  $myPdf = new Fpdf();

  // Adding a page to the pdf.
  $myPdf->AddPage();
  // Setting the font and it's size.
  $myPdf->SetFont("Arial", "", 12);

  // Displaying image on the pdf if present.
  if (!empty($img_name)) {
    $myPdf->Image("../uploads/$img_name", 149, 37.8, 50, 51);
  }

  // Generating the pdf.
  // Heading of pdf file.
  $myPdf->SetFont("Arial", "U", 16);
  $myPdf->Cell(0, 14, "Report Card", 1, 1, 'C');

  // Added a line break after Heading.
  $myPdf->Ln();

  // Full name of Applicant.
  $myPdf->SetFont("Arial", "", 14);
  $myPdf->Cell(40, 17, "Full Name: ", 1, 0);
  $myPdf->Cell(98, 17, $myForm->getFullName(), 1, 1);

  // Email address of Applicant.
  $myPdf->Cell(40, 17, "Email Address: ", 1, 0);
  $myPdf->Cell(98, 17, $myForm->getEmailAddress(), 1, 1);

  // Phone number of Applicant.
  $myPdf->Cell(40, 17, "Phone No.", 1, 0);
  $myPdf->Cell(98, 17, $myForm->getIndianPhoneNumber(), 1, 1);

  // Displaying Subject|Marks pairs in the form of table.
  $subMarks = explode("\n", $myForm->getSubjectMarks());
  // Adding a line break before the Subject|Marks table.
  $myPdf->Ln();
  // Changing to a different font.
  $myPdf->SetFont("Arial", "U", 16);

  // Subject|Marks table heading.
  $myPdf->Cell(0, 14, "Marks obtained", 0, 1, 'C');

  // Subject|Marks table headers.
  $myPdf->SetFont("Arial", "U", 14);
  $myPdf->cell(20, 14, "Sl No.", 1, 0, 'C');
  $myPdf->cell(85, 14, "Subject", 1, 0, 'C');
  $myPdf->cell(85, 14, "Marks", 1, 1, 'C');

  /* Forming Subject|Marks table in pdf. */
  $myPdf->SetFont("Arial", "", 12);
  $sl = 1;
  foreach ($subMarks as $line) {
    $parts = explode("|", $line);
    if (count($parts) == 2) {
      $subject = trim($parts[0]);
      $marks = trim($parts[1]);

      // Displaying a row of the table.
      $myPdf->cell(20, 14, $sl, 1, 0, 'C');
      $myPdf->cell(85, 14, $subject, 1, 0, 'C');
      $myPdf->cell(85, 14, $marks, 1, 1, 'C');
    }
    $sl++;
  }

  // Pdf file is named same as the full name.
  $filename = $myForm->getFullName();

  // A copy of the pdf is stored on the server.
  $myPdf->Output("F", "../pdfUploads/$filename.pdf");
  // A copy of the pdf is downloaded on client machine.
  $myPdf->Output("D",  "$filename.pdf");
}

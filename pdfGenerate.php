<?php

/* Including autoload.php file. */
require('./vendor/autoload.php');

/* Importing the Class file. */
require 'inputForm.php';

/* Requiring the Fpdf\Fpdf class. */
use Fpdf\Fpdf;

/* Creating a new Form object. */
$myForm = new Form();

/* When the form is submitted using POST method. */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Getting values input by the using $_POST superglobal 
       and perform some basic string sanitizations. */
    $fname = Form::testInput($_POST["fname"]);
    $lname = Form::testInput($_POST["lname"]);

    /* Regex to check for valid names. */
    $nameRegex = '/^[a-zA-Z\s\']+$/';

    /* Setting first name if user input is valid. */
    $myForm->fnameError = $myForm->checkInput($fname, $nameRegex);
    if ($myForm->fnameError == "") {
        $myForm->setFirstName($fname);
    }

    /* Setting last name if user input is valid. */
    $myForm->lnameError = $myForm->checkInput($lname, $nameRegex);
    if ($myForm->lnameError == "") {
        $myForm->setLastName($lname);
    }

    /* Setting Full name if both First and Last names are valid. */
    if ($myForm->fnameError == "" && $myForm->lnameError == "") {
        $myForm->setFullname();
    }

    /* Accepting image and saving it in the 'uploads' folder. */
    $img_name = $_FILES['image']['name'];
    $img_tmp = $_FILES['image']['tmp_name'];
    /* move $img_tmp to the required folder with the name with which it is saved */
    move_uploaded_file($img_tmp, "uploads/$img_name");

    /**
     * Extracting 'Subject|Marks' input by the user using $_POST[].
     * Declaring a regex to validate it. 
     * Find any other errors (if present).
     */
    $subjectMarks = $_POST["subjectMarks"];
    $subjectMarksRegex = '/^[a-zA-Z0-9|\s\n ]+$/';
    $myForm->subjectMarksError = $myForm->checkSubjectMarks($subjectMarks, $subjectMarksRegex);
    if ($myForm->subjectMarksError == "") {
        $myForm->setSubjectMarks($subjectMarks);
    }

    /**
     * Extracting Phone number input by the user using $_POST[].
     * Declaring a regex to validate it. 
     * Find any other errors (if present).
     */
    $indianPhoneNumber = $_POST["indianPhoneNumber"];
    $indianPhoneRegex = '/^(\+91)[1-9][0-9]{9}$/';
    $myForm->indianPhoneError = $myForm->indianPhoneCheck($indianPhoneNumber, $indianPhoneRegex);
    if ($myForm->indianPhoneError == "") {
        $myForm->setIndianPhoneNumber($indianPhoneNumber);
    }

    /**
     * Extracting Email address input by the user using $_POST[].
     * Find any other errors (if present) and 
     * assign it to the Object's corresponding Error property .
     */
    $emailAddress = $_POST["emailAddress"];
    $myForm->emailAddressError = $myForm->checkEmailAddress($emailAddress);
    if ($myForm->emailAddressError == "") {
        $myForm->setEmailAddress($emailAddress);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $myForm->checkNoError()) {

    /* Creating an object of Fpdf class. */
    $myPdf = new Fpdf();

    /* Adding a page to the pdf. */
    $myPdf->AddPage();

    /* Setting the font and it's size. */
    $myPdf->SetFont("Arial", "", 12);

    /* Displaying image on the pdf if present. */
    if (!empty($img_name)) {
        $myPdf->Image("uploads/$img_name", 149, 37.8, 50, 51);
    }

    /** 
     *   Generating the pdf file. 
     */

    /* Heading of pdf file. */
    $myPdf->SetFont("Arial", "U", 16);
    $myPdf->Cell(0, 14, "Report Card", 1, 1, 'C');

    /* Added a line break after Heading. */
    $myPdf->Ln();

    /* Full name of Applicant. */
    $myPdf->SetFont("Arial", "", 14);
    $myPdf->Cell(40, 17, "Full Name: ", 1, 0);
    $myPdf->Cell(98, 17, $myForm->getFullName(), 1, 1);

    /* Email address of Applicant. */
    $myPdf->Cell(40, 17, "Email Address: ", 1, 0);
    $myPdf->Cell(98, 17, $myForm->getEmailAddress(), 1, 1);

    /* Phone number of Applicant. */
    $myPdf->Cell(40, 17, "Phone No.", 1, 0);
    $myPdf->Cell(98, 17, $myForm->getIndianPhoneNumber(), 1, 1);
    $subMarks = explode("\n", $myForm->getSubjectMarks());

    /* Adding a line break before the Subject|Marks table. */
    $myPdf->Ln();

    $myPdf->SetFont("Arial", "U", 16);

    /* Subject|Marks table heading. */
    $myPdf->Cell(0, 14, "Marks obtained", 0, 1, 'C');

    /* Subject|Marks table headers. */
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

            $myPdf->cell(20, 14, $sl, 1, 0, 'C');
            $myPdf->cell(85, 14, $subject, 1, 0, 'C');
            $myPdf->cell(85, 14, $marks, 1, 1, 'C');
        }

        $sl++;
    }

    $filename = $myForm->getFullName();

    /* The pdf thus generated is displayed. */
    $myPdf->Output("F", "pdfUploads/$filename.pdf");
    $myPdf->Output("D",  "$filename.pdf");
}

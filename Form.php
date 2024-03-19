<?php

/* Defining the Form class which stores the Form information. */
class Form {

  /**
   * @var string $fname
   *  Stores the first name.
   */
  private $fname;

  /**
   * @var string $lname
   *  Stores the last name.
   */
  private $lname;

  /**
   * @var string $fullName
   *  Stores the full name.
   */
  private $fullName;



 /**
   * @var string $status
   *  Stores if there is any error in any input field.
   */
  private $status;

  /**
   * @var string $subjectMarks
   *  Stores the Subject|Marks pairs. One such pair in each line.
   */
  private $subjectMarks;

  /**
   * Error variables to store error messgaes for their
   * respective fields.
   */
  public $fnameError, $lnameError, $fullNameError;
  public $imageUploadError, $subjectMarksError;



  /* Non-parameterized constructor to initialize data members. */
  function __construct() {
    $this->fname = $this->lname = $this->fullName = "";
    $this->subjectMarks = "";
    $this->fnameError = $this->lnameError = "";
    $this->imageUploadError =  $this->subjectMarksError = "";
    $this->status = false;
  }

  /**
   * Method to check for specified conditions.
   *
   * @param string $data
   *  Data to be validated.
   * @param string $regex
   *  Regex to be validated against.
   *
   * @return string
   *  Relevant error message.
   */
  function checkInput($data, $regex): string {
    if (empty($data)) {
      return "This field is required";
    }
    elseif (strlen($data) < 2 || strlen($data) > 25) {
      return "Input length should be between 2 and 25";
    }
    elseif (!preg_match($regex, $data)) {
      return "Invalid input";
    }
    return "";
  }

  /* Method to check if there are no error messages */
  function checkNoError(): bool {
    if ($this->fnameError == "" && $this->lnameError == "" && $this->imageUploadError == ""
                          && $this->subjectMarksError == "") {
      $this->status = true;
    }
    return $this->status;
  }

  /**
   * Setter to set $this->fname.
   *
   * @var string $fname
   *  Contains the first name.
   */
  function setFirstName(string $fname): void {
    $this->fname = $fname;
  }

  /**
   * Setter to set $this->lname.
   *
   * @var string $lname
   *  Contains the last name.
   */
  function setLastName(string $lname): void {
    $this->lname = $lname;
  }

  /**
   * Getter to get $fname.
   *
   * @return string $this->fname
   *  Returns the first name.
   */
  function getFirstName(): string {
    return $this->fname;
  }

  /**
   * Getter to get $lname.
   *
   * @return string $this->fname
   *  Returns the last name.
   */
  function getLastName(): string {
    return $this->lname;
  }

  /**
   * Setter to set $fullName ($fname + $lname).
   */
  function setFullname() {
    $this->fullName = $this->fname . " " . $this->lname;
  }

  /**
   * Getter to get $this->fullName.
   *
   * @return string $this->fullName
   *  Returns the full name.
   */
  function getFullName(): string {
    return $this->fullName;
  }

  /**
   * Setter to set $this->subjectMarks.
   *
   * @var string $data
   *  Contains the Subject|Marks pairs.
   */
  function  setSubjectMarks($data): void {
    $this->subjectMarks = $data;
  }

  /**
   * Getter to get $this->subjectMarks.
   *
   * @return string $this->subjectMarks
   *  Returns the Subject|Marks pairs. One pair in each line.
   */
  function getSubjectMarks() {
    return $this->subjectMarks;
  }

  /**
   * Performs some basic string sanitizations.
   *
   * @param string $data
   *  Data to be sanaitized.
   *
   * @return string $data
   *  Sanitized string
   */
  public static function testInput(string $data): string {
    // Trimming extra spaces.
    $data = trim($data);
    // Removing slashes.
    $data = stripslashes($data);
    return $data;
  }

  /* Method to validate the all 'Subject|Marks'. */
  function checkSubjectMarks($data, $regex) {
    if (empty($data)) {
      // No data is entered.
      return "No subject|marks pairs entered";
    }
    elseif (!preg_match($regex, $data)) {
      // If input contains forbidden characters.
      return "Only alphabets, digits and | allowed";
    }
    else {
      // Validating each Subject|Marks pair.
      $lines = explode("\n", $data);
      $numberOfLines = count($lines);
      for ($i = 0; $i < $numberOfLines; $i++) {
        $subjectMarksPair = explode("|", $lines[$i]);
        // Trimming amy extra space in subject and marks.
        $subject = trim($subjectMarksPair[0], " \t\n\r\0\x0B");
        $marks = trim($subjectMarksPair[1], " \t\n\r\0\x0B");
        if (count($subjectMarksPair) !== 2 || is_numeric($subject) || !is_numeric($marks)) {
          // If Subject is numeric or Marks is non-numeric or incorrect format.
          return "Invalid Pairs";
        }
        elseif ($subjectMarksPair[1] > 100) {
          // If marks greater than 100 is entered.
          return "Marks cannot be greater than 100";
        }
      }
    }
    return "";
  }
}

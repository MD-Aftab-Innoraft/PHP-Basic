<?php

/**
 * Defining the Form class which stores the Form's information
 * in its properties and consists of methods to operate on them.
 */
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
   * @var bool $status
   *  Maintains if every field is properly filled.
   */
  private $status;

  /**
   * @var string $subjectMarks
   *  Stores the Subject|Marks pairs.
   */
  private $subjectMarks;

  /**
   * @var string $indianPhoneNumber
   *  Stores an Indian phone number.
   */
  private $indianPhoneNumber;

  /**
   * Error variables to maintain error in the respective input fields.
   */
  public $fnameError, $lnameError, $fullNameError, $subjectMarksError;
  public $imageUploadError, $indianPhoneError;

  /**
   * Non-parameterized constructor to initialize data members.
   */
  function __construct() {
    $this->fname = $this->lname = $this->fullName = "";
    $this->subjectMarks = $this->indianPhoneNumber = "";
    $this->fnameError = $this->lnameError = "";
    $this->imageUploadError =  $this->subjectMarksError = "";
    $this->indianPhoneError = "" ;
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
    // No user input.
    if (empty($data)) {
      return "This field is required";
    }
    // Input length is not within specified limits.
    else if (strlen($data) < 2 || strlen($data) > 25) {
      return "Input length should be between 2 and 25";
    }
    // Contains invalid characters.
    else if (!preg_match($regex, $data)) {
      return "Invalid input";
    }
    // No error.
    return "";
  }

  /**
   * Method to check if there are no error messages.
   *
   * @return bool
   *  true if no errors, false otherwise.
   */
  function checkNoError(): bool {
    if ($this->fnameError == "" && $this->lnameError == "" && $this->imageUploadError == ""
                && $this->subjectMarksError == "" && $this->subjectMarksError == "") {
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
   * Getter to get $fullName.
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
   * Getter to get subjectMarks pairs.
   *
   * @return string $this->subjectMarks
   *  Returns the Subject|Marks pairs. One pair in each line.
   */
  function getSubjectMarks() {
    return $this->subjectMarks;
  }

  /**
   * Setter to set $this->indianPhoneNumber.
   *
   * @param string $phone
   *  Contains phone number.
   */
  function setIndianPhoneNumber($phone) {
    $this->indianPhoneNumber = $phone;
  }

  /**
   * Getter to get $this->indianPhoneNumber.
   *
   * @return string $this->indianPhoneNumber
   *  Returns the Indian Phone number.
   */
  function getIndianPhoneNumber () {
    return $this->indianPhoneNumber;
  }

  /**
   * Performs some basic sanitizations on the user input.
   *
   * @param string $data
   *  Data to be sanitized.
   *
   * @return string
   *  Sanitized string '$data'.
   */
  public static function testInput(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
  }

  /**
   * Method to validate 'Subject|Marks' pairs.
   *
   * @param string $data
   *  Data to be verified.
   * @param string $regex
   *  Regex to be validated against.
   *
   * @return string
   *  Stating error message(if any).
   */
  function checkSubjectMarks($data, $regex) {
    // No data is entered.
    if (empty($data)) {
      return "No subject|marks pairs entered";
    }
    // If input contains forbidden characters.
    elseif (!preg_match($regex, $data)) {
      return "Only alphabets, digits and | allowed";
    }
    // Validating each Subject|Marks pair.
    else {
      $lines = explode("\n", $data);
      $numberOfLines = count($lines);
      for ($i = 0; $i < $numberOfLines; $i++) {
        $subjectMarksPair = explode("|", $lines[$i]);
        // Trimming amy extra space in subject and marks.
        $subject = trim($subjectMarksPair[0], " \t\n\r\0\x0B");
        $marks = trim($subjectMarksPair[1], " \t\n\r\0\x0B");
        // If Subject is numeric or Marks is non-numeric or incorrect format.
        if (count($subjectMarksPair) !== 2 || is_numeric($subject) || !is_numeric($marks)) {
          return "Invalid Pairs";
        }
        // If marks greater than 100 is entered.
        elseif ($subjectMarksPair[1] > 100) {
          return "Marks cannot be greater than 100";
        }
      }
    }
    // No error.
    return "";
  }

  /**
   * Method to validate Indian Phone Number.
   *
   * @param string $phoneNumber
   *  Phone number to be validated.
   * @param string $phoneNumberRegex
   *  Regex to be validated against.
   *
   * @return string
   *  Stating error message(if any).
   */
  function indianPhoneCheck($phoneNumber, $phoneNumberRegex): string {
    $phoneNumber = trim($phoneNumber, " \t\n\r\0\x0B");
    // No user input.
    if(empty($phoneNumber)) {
      return "Phone number is required";
    }
    // Contains invalid character(s).
    else if (!preg_match($phoneNumberRegex, $phoneNumber)) {
      return "Only digits and + symbol allowed";
    }
    // No error.
    return "";
  }
}

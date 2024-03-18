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
   * @var string $status
   *  Stores if there is any error in any input field.
   */
  private $status;

  /**
   * Error variables to store error messgaes for their
   * respective fields.
   */
  public $fnameError, $lnameError, $fullNameError;
  public $imageUploadError;

  /* Non-parameterized constructor to initialize data members. */
  function __construct() {
    $this->fname = $this->lname = $this->fullName = "";
    $this->fnameError = $this->lnameError = "";
    $this->imageUploadError = "";
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
  function checkInput($data,$regex): string {
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

  /**
   * Method to check if there are no errors in user inputs.
   *
   * @return bool
   *  true if no errors, false otherwise.
   */
  function checkNoError() : bool{
  if($this->fnameError == "" && $this->lnameError == "" && $this->imageUploadError == "") {
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
  function setFirstName(string $fname) {
    $this->fname = $fname;
  }

  /**
   * Setter to set $this->lname.
   *
   * @var string $fname
   *  Contains the last name.
   */
  function setLastName(string $lname) {
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
   * @return string $this->lname
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
}

?>


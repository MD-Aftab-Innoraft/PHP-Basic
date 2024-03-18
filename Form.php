<?php

/**
 * Form class to store the form inputs entered by the user.
 */
class Form {

  /**
   * @var string
   *  Stores the input first name.
   */
  private $fname;

  /**
   * @var string
   *  Stores the input last name.
   */
  private $lname;

  /**
   * @var string
   *  Stores the full name($fname + $lname).
   */
  private $fullName;

  /**
   * @var boolean
   *  TRUE (if every input is properly filled),
   *  FALSE otherwise.
   */
  private $status;

  /**
   * @var string
   *  Stores the 'Subject|Marks' pairs.
   *  One such pair in each line.
   */
  private $subjectMarks;

  /**
   * @var string
   *  Stores an Indian Phone number. 
   */
  private $indianPhoneNumber;

  /**
   * @var string
   *  Stores the input email address. 
   */
  private $emailAddress;

  /* Error variables to maintain error msg for respective input fields. */
  public string $fnameError, $lnameError, $fullNameError, $subjectMarksError;
  public string $imageUploadError, $indianPhoneError, $emailAddressError;

  /* Non-parameterized constructor to initialize data members. */
  function __construct() {
    $this->fname = $this->lname = $this->fullName = "";
    $this->subjectMarks = $this->indianPhoneNumber = "";
    $this->fnameError = $this->lnameError = "";
    $this->imageUploadError =  $this->subjectMarksError = "";
    $this->indianPhoneError = $this->emailAddressError = "";
    $this->status = FALSE;
  }

  /**  
   *  Method to check input for specified conditions and 
   *  update error messages for name inputs.
   * 
   *  @param string $data
   *   Data to be verified.
   * 
   *  @param string $regex
   *   Regex to be validated against.
   * 
   *  @return  string 
   *   Stating error message(if any).
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
    else {
      return "";
    }
  }

  /** 
   *  Method to check if there are no error messages.
   * 
   *  @return bool
   *   TRUE if no errors, FALSE otherwise.
   */
  function checkNoError(): bool {
    if (
      $this->fnameError == "" && $this->lnameError == "" && $this->imageUploadError == ""
      && $this->subjectMarksError == "" && $this->subjectMarksError == ""
      && $this->emailAddressError == "") {

      $this->status = TRUE;
    }
    return $this->status;
  }

  /**
   * Setter to set the First name ($fname). 
   * 
   * @param string $fname
   *  Input first name.
   */
  function setFirstName(string $fname) {
    $this->fname = $fname;
  }

  /**
   *  Setter to set the Last name ($lname). 
   * 
   *  @param string $lname
   *   Input last name.
   */
  function setLastName(string $lname) {
    $this->lname = $lname;
  }

  /**
   *  Getter to get the First name ($fname).
   * 
   *  @return string
   *   Returns the first name.
   */
  function getFirstName(): string {
    return $this->fname;
  }

  /**
   *  Getter to get the Last name ($lname). 
   * 
   *  @return string 
   *   Returns the last name.
   */
  function getLastName(): string {
    return $this->lname;
  }

  /**
   *  Sets the $fullName ($fname + $lname). 
   */
  function setFullname() {
    $this->fullName = $this->fname . " " . $this->lname;
  }

  /**
   *  Getter to get the fullname ($fullName).
   * 
   * @return string
   *  Returns the full name.
   */
  function getFullName(): string {
    return $this->fullName;
  }

  /** 
   * @param string 
   *  Stores the 'Subject|Marks' pairs.
   */
  function  setSubjectMarks($data) {
    $this->subjectMarks = $data;
  }

  /**
   *  Getter returns the 'Subject|Marks' pairs as a string.
   * 
   * @return string
   *  Returns the 'Subject|Marks' pairs.
   */
  function getSubjectMarks(): string {
    return $this->subjectMarks;
  }

  /**
   * Setter to set the phone number.
   * 
   * @param string $phone
   *  Stores the Indian Phone number.
   */
  function setIndianPhoneNumber($phone) {
    $this->indianPhoneNumber = $phone;
  }

  /** 
   * Getter to get the Indian Phone Number. 
   * 
   * @return string
   *  Returns Indian Phone number.
   */
  function getIndianPhoneNumber(): string {
    return $this->indianPhoneNumber;
  }

  /**
   * Setter to set the email address.
   * 
   * @param string $email
   *  Input email address.
   */
  function setEmailAddress(string $email) {
    $this->emailAddress = $email;
  }

  /**
   * Gets the email address.
   * 
   * @return string
   *  Returns email adress.
   */
  function getEmailAddress(): string {
    return $this->emailAddress;
  }

  /** 
   *  Performs some basic sanitizations on the user input. 
   * 
   *  @param string $data
   *   Data to be sanitized.
   * 
   *  @return string 
   *   Sanitized string $data.
   */
  public static function testInput(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);

    return $data;
  }

  /**
   * Validates 'Subject|Marks' pairs.
   * 
   * @param string $data
   *  Data to be verified.
   * 
   * @param string $regex
   *  Regex to be validated against.
   * 
   * @return string
   *  Relevant error message.
   */
  function checkSubjectMarks($data, $regex): string {
    $data = trim($data, " \t\n\r\0\x0B");
    if (empty($data)) {
      return "No subject|marks pairs entered";
    } 
    elseif (!preg_match($regex, $data)) {
      return "Only alphabets, digits and | allowed";
    } 
    else {
      /* Validating each Subject|Marks pair. */
      $lines = explode("\n", $data);
      $numberOfLines = count($lines);

      for ($i = 0; $i < $numberOfLines; $i++) {
        $subjectMarksPair = explode("|", $lines[$i]);

        if (count($subjectMarksPair) !== 2 || is_numeric($subjectMarksPair[0]) || !is_numeric($subjectMarksPair[1])) {
          return "Invalid Pairs";
        } 
        elseif ($subjectMarksPair[1] > 100) {
          return "Marks cannot be greater than 100";
        }
      }
    }
    return "";
  }

  /**
   * Validates for an Indian Phone number.
   * 
   * @param string $phoneNumber
   *  Phone number to be validated.
   * 
   * @param string $phoneNumberRegex
   *  Regex to be validated against.
   * 
   * @return string 
   *  Stating error message(if any).
   */
  function indianPhoneCheck($phoneNumber, $phoneNumberRegex): string {
    $phoneNumber = trim($phoneNumber, " \t\n\r\0\x0B");
    if (empty($phoneNumber)) {
      return "Phone number is required";
    } 
    elseif (!preg_match($phoneNumberRegex, $phoneNumber)) {
      return "Only digits and + symbol allowed";
    } 
    else {
      return "";
    }
  }

  /**
   *  Validates the Email Address.
   *  
   *  @param string $email
   *   Email to be validated.
   * 
   *  @return string 
   *   Stating error message(if any).
   */
  function checkEmailAddress(string $email): string
  {
    $email = trim($email, " \t\n\r\0\x0B");
    if (empty($email)) {
      return "Email address is required";
    } 
    elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
      return "Email address is invalid";
    } 
    else {
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://emailvalidation.abstractapi.com/v1/?api_key=46cc4fa558dd4a17b2fbbd8402620c2e&email=' . $email);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

      $response = curl_exec($ch);

      curl_close($ch);

      $data = json_decode($response, true);

      if (
        $data["deliverability"] != "DELIVERABLE" || $data["is_valid_format"]["text"] != "TRUE"
                                                 || $data["is_disposable_email"]["text"] != "FALSE") {
        return "Email address not found.";
      }
    }
    return "";
  }
}


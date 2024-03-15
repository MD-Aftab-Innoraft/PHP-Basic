<?php

/* Form class to store the Form's information. */
class Form
{

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
   *  TRUE(if every input is properly filled),
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
  function __construct()
  {
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
   *  @param string 
   *   data to be verified.
   * 
   *  @param string
   *   regex to be validated against.
   * 
   *  @return  string 
   *   stating error message(if any).
   */
  function checkInput($data, $regex): string
  {
    if (empty($data)) {
      return "This field is required";
    } else if (strlen($data) < 2 || strlen($data) > 25) {
      return "Input length should be between 2 and 25";
    } else if (!preg_match($regex, $data)) {
      return "Invalid input";
    } else {
      return "";
    }
  }

  /** 
   *  Method to check if there are no error messages.
   * 
   *  @param  none
   *   no input parameters.
   * 
   *  @return boolean
   *   TRUE if no errors, FALSE otherwise.
   */
  function checkNoError(): bool
  {
    if (
      $this->fnameError == "" && $this->lnameError == "" && $this->imageUploadError == ""
      && $this->subjectMarksError == "" && $this->subjectMarksError == ""
      && $this->emailAddressError == ""
    ) {
      $this->status = TRUE;
    }
    return $this->status;
  }

  /**
   * Setter to set the First name ($fname). 
   * 
   * @param string
   *  input first name.
   * 
   * @return none
   */
  function setFirstName(string $fname)
  {
    $this->fname = $fname;
  }

  /**
   *  Setter to set the Last name ($lname). 
   *  @param string
   *   input last name.
   * 
   *  @return none*/
  function setLastName(string $lname)
  {
    $this->lname = $lname;
  }

  /**
   *  Getter to get the First name ($fname).
   *  
   *  @param none
   * 
   *  @return string
   *   returns the first name.
   */
  function getFirstName(): string
  {
    return $this->fname;
  }

  /**
   *  Getter to get the Last name ($lname). 
   *  @param none
   * 
   *  @return string 
   *   returns the last name.
   */
  function getLastName(): string
  {
    return $this->lname;
  }

  /* Sets the $fullName ($fname + $lname). */
  function setFullname()
  {
    $this->fullName = $this->fname . " " . $this->lname;
  }

  /**
   *  Gets the fullname ($fullName).
   * 
   * @param none
   * 
   * @return string
   *  returns the full name.
   */
  function getFullName(): string
  {
    return $this->fullName;
  }

  /** 
   * @param string 
   *  Stores the 'Subject|Marks' pairs.
   */
  function  setSubjectMarks($data)
  {
    $this->subjectMarks = $data;
  }

  /**
   *  Getter returns the 'Subject|Marks' pairs as a string.
   * 
   * @param none
   * 
   * @return string
   *  returns the 'Subject|Marks' pairs.
   */
  function getSubjectMarks(): string
  {
    return $this->subjectMarks;
  }

  /**
   * Setter to set the phone number.
   * 
   * @param string
   *  stores the Indian Phone number.
   */
  function setIndianPhoneNumber($phone)
  {
    $this->indianPhoneNumber = $phone;
  }

  /** 
   * Getter to get the Indian Phone Number. 
   * @param none
   * 
   * @return string
   *  returns Indian Phone number.
   */
  function getIndianPhoneNumber(): string
  {
    return $this->indianPhoneNumber;
  }

  /**
   * Setter to set the email address.
   * @param string
   *  input email address
   * 
   * @return none
   */
  function setEmailAddress(string $data)
  {
    $this->emailAddress = $data;
  }

  /**
   * Gets the email address.
   * @param none
   * 
   * @return string
   *  email adress.
   */
  function getEmailAddress(): string
  {
    return $this->emailAddress;
  }

  /** 
   *  Performs some basic sanitizations on the user input. 
   *  @param string 
   *   data to be sanitized.
   * 
   *  @return string 
   *   Sanitized string '$data'.
   */
  public static function testInput(string $data): string
  {
    $data = trim($data);
    $data = stripslashes($data);

    return $data;
  }

  /**
   * Validates 'Subject|Marks' pairs.
   * 
   * @param string data
   *  data to be verified.
   * @param string
   *  regex to be validated against.
   * 
   * @return string
   *  contains relevant error message
   */
  function checkSubjectMarks($data, $regex): string
  {
    $data = trim($data, " \t\n\r\0\x0B");
    if (empty($data)) {
      return "No subject|marks pairs entered";
    } 
    elseif (!preg_match($regex, $data)) {
      return "Only alphabets, digits and | allowed";
    } 
    else {
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
   * @param  string 
   *  phoneNumber to be validated.
   * @param string 
   *  regex to be validated against.
   * 
   * @return string 
   *  stating error message(if any).
   */
  function indianPhoneCheck($phoneNumber, $phoneNumberRegex): string {
    $phoneNumber = trim($phoneNumber, " \t\n\r\0\x0B");
    if (empty($phoneNumber)) {
      return "Phone number is required";
    } 
    else if (!preg_match($phoneNumberRegex, $phoneNumber)) {
      return "Only digits and + symbol allowed";
    } 
    else {
      return "";
    }
  }

  /**
   *  Validates the Email Address.
   *  
   *  @param string 
   *   email to be validated.
   * 
   *  @return string 
   *   stating error message(if any).
   */
  function checkEmailAddress(string $email): string
  {
    $email = trim($email, " \t\n\r\0\x0B");
    if (empty($email)) {
      return "Email address is required";
    } 
    else if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
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


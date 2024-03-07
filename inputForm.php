<?php

/* Defining the Form class which stores the Form information. */
class Form {

    /**
    *  Declaring the Class variables:
    * (i)   $fname: stores the First name
    * (ii)  $lname: stores the Last name
    * (iii) $fullName as private to implement encapsulation 
    *        and enhance security. 
    */
    private $fname;
    private $lname;
    private $fullName;

    /* Maintains if every field is properly filled. */
    private $status;

    /* Stores the 'Subject|Marks pairs. One such pair in each line */
    private $subjectMarks;

    /* Stores an Indian Phone number. */
    private $indianPhoneNumber;

    /* Error variables to maintain error in the respective input fields. */
    public $fnameError, $lnameError, $fullNameError, $subjectMarksError;
    public $imageUploadError, $indianPhoneError;

    /* Non-paramseterized constructor to initialize data members. */
    function __construct() {
        $this->fname = $this->lname = $this->fullName = "";
        $this->subjectMarks = $this->indianPhoneNumber = "";
        $this->fnameError = $this->lnameError = "";
        $this->imageUploadError =  $this->subjectMarksError = "";
        $this->indianPhoneError = "" ;
        $this->status = false;
    }

    /**  
    *   Method to check input for specified conditions and 
    *   update error messages for name inputs.
    *   @params: (i)  string '$data' to be verified.
    *            (ii) string '$regex' to be validated against.
    *   @returns: string stating error message(if any).
    */
    function checkInput($data, $regex): string {
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
    *   Method to check if there are no error messages 
    *   @params: takes no input paramsetrs.
    *   @returns: bool(true if no errors, false otherwise).
    */
    function checkNoError(): bool {
        if ($this->fnameError == "" && $this->lnameError == "" && $this->imageUploadError == ""
                    && $this->subjectMarksError == "" && $this->subjectMarksError == "") {
            $this->status = true;
        }
        return $this->status;
    }

    /* Setter to set the First name i.e., $fname. */
    function setFirstName(string $fname) {
        $this->fname = $fname;
    }

    /* Setter to set the Last name i.e., $lname. */
    function setLastName(string $lname) {
        $this->lname = $lname;
    }

    /* Getter to get the First name i.e., $fname. */
    function getFirstName(): string {
        return $this->fname;
    }

    /* Getter to get the Last name i.e., $lname. */
    function getLastName(): string {
        return $this->lname;
    }

    /* Sets the $fullName ($fname + $lname). */
    function setFullname() {
        $this->fullName = $this->fname . " " . $this->lname;
    }

    /* Gets the fullname i.e., $fullName. */
    function getFullName(): string {
        return $this->fullName;
    }

    /* Setter to set the Subject|Marks pairs as a string. */
    function  setSubjectMarks($data) {
        $this->subjectMarks = $data;
    }

    /* Getter which returns the Subject|Marks pairs as a string. */
    function getSubjectMarks() {
        return $this->subjectMarks;
    }

    /* Setter to set the Indian Phone number. */
    function setIndianPhoneNumber($phone) {
        $this->indianPhoneNumber = $phone;
    }

    /* Getter to get the Indian Phone Number. */
    function getIndianPhoneNumber () {
        return $this->indianPhoneNumber;
    }

    /** 
    *   Performs some basic sanitizations on the user input. 
    *   @params: string '$data' to be sanitized.
    *   @returns: sanitized string '$data'.
    */
    public static function testInput(string $data): string {
        $data = trim($data);                
        $data = stripslashes($data);        
        $data = htmlspecialchars($data);    
        return $data;
    }

    /** 
    *   Method to validate the all 'Subject|Marks' pairs. 
    *   @params: (i)  string '$data' to be verified.
    *            (ii) string 'regex' to be verified against.
    *   @returns: string stating error message(if any).
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
            $lines = explode("\n", $data);
            $numberOfLines = count($lines);

            for ($i = 0; $i < $numberOfLines; $i++) {
                $subjectMarksPair = explode("|", $lines[$i]);

                if (count($subjectMarksPair) !== 2 || is_numeric($subjectMarksPair[0]) || !is_numeric($subjectMarksPair[1])) {
                    return "Invalid Pairs";
                } elseif ($subjectMarksPair[1] > 100) {
                    return "Marks cannot be greater than 100";
                }
            }
        }
        return "";
    }

    /**
     * Method to validate the Phone Number.
     * @params: (i)  string '$phoneNumber' to be validated.
     *          (ii) string '$phoneNumberRegex' to be verified against.
     * @returns: string stating error message(if any).
     */
    function indianPhoneCheck($phoneNumber, $phoneNumberRegex): string {
        $phoneNumber = trim($phoneNumber, " \t\n\r\0\x0B");
        if(empty($phoneNumber)) {
            return "Phone number is required";
        }
        else if (!preg_match($phoneNumberRegex, $phoneNumber)) {
            return "Only digits and + symbol allowed";
        }
        else {
            return "";
        }
    }

}


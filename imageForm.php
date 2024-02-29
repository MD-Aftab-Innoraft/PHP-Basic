<?php

class Form
{
    private $fname;
    private $lname;
    private $fullname;

    public $fnameErr, $lnameErr;

    function __construct()
    {
        $this->fname = $this->lname = $this->fullname = "";
        $this->fnameErr = $this->lnameErr = "";
    }

    function setFirstName(string $fname)
    {
        $this->fname = $fname;
    }
    function setLastName(string $lname)
    {
        $lname = $this->testInput($lname);
        $this->lname = $lname;
    }

    function getFirstName(): string
    {
        return $this->fname;
    }

    function getLastName(): string
    {
        return $this->lname;
    }

    function setFullname()
    {
        $this->fullname = $this->fname . " " . $this->lname;
    }

    function getFullName(): string {
        return $this->fullname;
    }

    private function testInput(string $data): string
    {   // performs some basic sanitizations for input
        $data = trim($data);                // trim spaces
        $data = stripslashes($data);        // remove slashes
        $data = htmlspecialchars($data);    // convert special chars to HTML entities
        return $data;
    }

    function __destruct()
    {
        // echo "The object of $this->fullname was destroyed";
    }
}

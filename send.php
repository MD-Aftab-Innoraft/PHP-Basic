<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Requiring the autoload file. */
require 'vendor/autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

$myEmail = $_POST['email'];

/* Creating a new PHPMailer object. */
$mail = new PHPMailer(true);

try {
		
    /* Configuring the server settings. */
	$mail->isSMTP();										 
	$mail->Host	 = 'smtp.gmail.com;';				 
	$mail->SMTPAuth = true;							 
	$mail->Username = 'aftabansari1024@gmail.com';				 
	$mail->Password = 'kbgn mieq mmcy cxcf';					 
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	 = 587; 

	$mail->setFrom('aftabansari1024@gmail.com', 'Aftab' );		 
	$mail->addAddress($myEmail);
	
	$mail->isHTML(true);	

    /* Email subject. */					 
	$mail->Subject = 'Registration successfull.';

    /* Email message. */
	$mail->Body = 'Thank you for your submission';

	$mail->send();
	echo "Mail has been sent successfully!";

} 
catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

?>


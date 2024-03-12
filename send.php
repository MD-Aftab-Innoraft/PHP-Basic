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
	$mail->Host	 = 'smtp.gmail.com';				 
	$mail->SMTPAuth = true;							 
	$mail->Username = 'aftabansari1024@gmail.com';				 
	$mail->Password = 'kbgn mieq mmcy cxcf';					 
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	 = 587; 

	$mail->setFrom('aftabansari1024@gmail.com', 'Aftab Ansari' );		 
	$mail->addAddress($myEmail);
	
	$mail->isHTML(true);	

    /* Email subject. */					 
	$mail->Subject = 'Registration successfull.';

    /* Email message. */
	$mail->Body = 'Thank you for your submission';

	$mail->send();
	$mailMsg = "Mail has been sent successfully!";

} 
catch (Exception $e) {
	$mailMsg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Message</title>
	<style>
		body {
			background-image: linear-gradient(to top, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
			min-height: 100svh;
		}

		#msg{
			font-size: 25px;
			height: 100svh;
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
</head>
<body>
	<div id="msg">
		<?php  echo $mailMsg; ?>
	</div>
</body>
</html>


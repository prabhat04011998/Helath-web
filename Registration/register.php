<?php
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD']==='POST'){
	try{
		$result = array();
		$name = test_input($_POST['name']);
		$phone = test_input($_POST['phone']);
		$email = test_input($_POST['email']);
		$city = test_input($_POST['city']);
		$company = test_input($_POST['company']);

		SendEmail($email,$name,$phone,$city,$company);
		$result['message'] = "Your response submitted succesfully!";
		$result['code'] = 1;
		
	}
	catch(PDOException $e){
		$result['message'] = "There is some problem. Please Try After Sometime";
		$result['code']=0;
	}
	echo json_encode($result);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function SendEmail($email_from,$name,$mobile,$city,$company){
	$email_to = "info@neworanie.com"; // Specify the email address you want to send the mail to.
	$email_subject = "Registration from website"; 	// Set the subject of your email.
	
	// Validate the email address entered by the user
	if(!filter_var($email_from, FILTER_VALIDATE_EMAIL)) {
		// Invalid email address
		die("The email address entered is invalid.");
	}
	
	// The code below creates the email headers, so the email appears to be from the email address filled out in the previous form.
	// NOTE: The \r\n is the code to use a new line.
	$headers  = "From: " . $email_from . "\r\n";
	$headers .= "Reply-To: " . $email_from . "\r\n";	// (You can change the reply email address here if you want to.)
	
	// Now we can construct the email body which will contain the name and message entered by the user
	$message = "Name: ". $name  . "\r\nPhone: ". $mobile ."\r\nEmail: " . $email_from ."\r\nCity: " . $city ."\r\nCompany: " . $company;
	
	// This is the important ini_set command which sets the sendmail_from address, without this the email won't send.
	ini_set("sendmail_from", $email_from);
	
	// Now we can send the mail we've constructed using the mail() function.
	// NOTE: You must use the "-f" parameter on Fasthosts' system, without this the email won't send.
	$sent = mail($email_to, $email_subject, $message, $headers, "-f" . $email_from);
}
?>
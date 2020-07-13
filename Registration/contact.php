<?php

$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$city = $_REQUEST['city'];
$company = $_REQUEST['company'];

if(empty($name)|| empty($phone) || empty($message))
{
	echo "please fill all the fields";
}
else{
	mail("info@neworanie.com"," Register Now", $name, $phone, $email);
	echo "<script type='text/javascript'>
	alert('Your response submitted succesfully!');
	window.history.log(-1);
	</script>";
}


?>
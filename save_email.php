<?php 
// Save e-mail address
include 'fn_message.php';

$email = trim($_REQUEST['email']);
$psw = $_REQUEST['psw'];
$user = $_REQUEST['user'];
$id = $_REQUEST['id'];

if ($psw != "3304")
{
	message("Invalid password!");
	exit;
}

if ($email != "")
{
	if (!strpos($email,"@") || !strpos($email,"."))
	{
		message("Invalid e-mail address!");
		exit;
	}
}


file_put_contents("logbooks/email_address.txt",$email);

header ("Location: welcome.php?id=$id&user=$user");


?>
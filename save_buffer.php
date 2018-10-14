<?php

include 'fn_message.php';

$id = $_REQUEST['id'];
$dag = $_REQUEST['dag'];
$user = $_REQUEST['user'];
$laser = $_REQUEST['laser'];
$sample = $_REQUEST['sample'];
$comment = $_REQUEST['comment'];

	if ($dag=="" || $user=="" || $laser=="" || $sample=="" || $comment=="")
	{
		message("Please fill all fields");
		exit;
	}
	
	if(!$handle=fopen("logbooks/buffer.log","a"))
	{
		message("An error occurred.");
		exit;
	}
	$user = str_replace(";", ",", $user);
	$laser = str_replace(";", ",", $laser);
	$sample = str_replace(";", ",", $sample);
	$comment = str_replace(";", ",", $comment);
	$comment = str_replace("\r\n", " ", $comment);
	
	
//	$line = $dag.";".$user.";".$laser.";".$sample.";".$comment."\n";
	$line = "$dag;$user;$laser;$sample;$comment\n";
	fwrite($handle, $line);
	fclose($handle);

// set a timeout for the session
	$id=sprintf("%x",time() + 1200);

	// send email to me if the message is longer than 5 characters
	// $to = "hakan.rundlof@kemi.uu.se";
	$to = file_get_contents("logbooks/email_address.txt");
	$to = trim($to);
	if (strlen($comment) >10 && $to != "")
	{
		$headers  ="MIME-Version: 1.0\r\n";
		// $headers .="Content-Type: text/plain; charset=utf-8" . "\r\n";
		$headers .="Content-Type: text/plain; charset=ISO-8859-1" . "\r\n";
		$headers .="Content-Transfer-Encoding: Quoted-Printable" . "\r\n";

		$from="Raman logbook <noreply@kemi.uu.se>";
		$msg="\n$user reports the following in the Raman logbook:\n\n";
		$msg=$msg."$comment\n\n";
		$subj="Raman logbook message";

		mail($to, $subj, $msg, $headers."From: $from");
	}


	header ("Location: welcome.php?id=$id&user=$user");


?>

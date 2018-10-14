<?php 
// Login
include 'fn_message.php';
include 'fn_idgen.php';

$psw = $_REQUEST['psw'];
$psw = trim($psw);
$user = $_REQUEST['user'];
$user = trim($user);

// set a timeout for the session
$id=sprintf("%x",time() + 1200);

if ($psw != "3304")
{
	header ("Location: index.htm");
	exit;
}


// If the buffer is not empty, then the previous user did not logout. Fix that

	$buffer = file_get_contents("logbooks/buffer.log");
	if ($buffer != "")
	{
		$lastlog = file_get_contents("logbooks/this_month.log");
		file_put_contents("logbooks/this_month.log", $lastlog.$buffer);
		file_put_contents("logbooks/buffer.log","");
	}

// Check if we have a new month

	if(!$handle=fopen("logbooks/this_month.log","r"))
	{
		message("An error occurred.");
		exit;
	}
// read first line which is the current month in format 2016-01

	$month=fgets($handle);
	fclose($handle);
	
//	$month = date('F Y', strtotime($line));
	$thismonth = date('Y-m', time());
		
	if ($thismonth != trim($month))
	{

// We have a new month. Store the previous at the beginning of the raman_3304.log
		$thismonth = $thismonth."\n";

		$log = file_get_contents("logbooks/raman_3304.log");
		$prevlog = file_get_contents("logbooks/prev_month.log");
		file_put_contents("logbooks/raman_3304.log", $prevlog.$log);

		$lastlog = file_get_contents("logbooks/this_month.log");
		file_put_contents("logbooks/prev_month.log", $lastlog);

		file_put_contents("logbooks/this_month.log", $thismonth);
		file_put_contents("logbooks/buffer.log","");

	}

//	header ("Location: welcome.php?id=".$id."&user=".$user);
	header ("Location: welcome.php?id=$id&user=$user");

?>
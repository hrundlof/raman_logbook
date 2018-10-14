<?php

include 'fn_message.php';

$id = $_REQUEST['id'];
$user = $_REQUEST['user'];


// read the buffer
	if(!$handle=fopen("logbooks/buffer.log","r"))
	{
		message("An error occurred.");
		exit;
	}
	$num=0;
	while (!feof($handle))
	{
		$arr[$num] = fgets($handle);
		if ($arr[$num] == "") {break;}
		$num = $num + 1;
	}
	fclose($handle);
	
// write WITHOUT last line
	if ($arr[0] != "") 
	{
		$num = $num - 1;
		if(!$handle=fopen("logbooks/buffer.log","w"))
		{
			message("An error occurred.");
			exit;
		}
		for ($i = 0; $i < $num; $i++)
		{
			fwrite($handle, $arr[$i]);
		}
		fclose($handle);
	}
	
// set a timeout for the session
	$id=sprintf("%x",time() + 1200);

//	header ("Location: welcome.php?id=".$id."&user=".$user);
	header ("Location: welcome.php?id=$id&user=$user");


?>

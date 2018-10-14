<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Raman Logbook</TITLE>
<META NAME="Generator" CONTENT="">
<meta http-equiv="refresh" content="1250">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<META NAME="Author" CONTENT="hr">
<META NAME="Keywords" CONTENT="?">
<META NAME="Description" CONTENT="?">

<style type="text/css">
a {text-decoration: none;color: blue;}
input {font: 13px arial;}
textarea {font: 13px arial;}
</style>

</HEAD>

<BODY style="background-color:powderblue;font: 18px arial, sans-serif;">
<center>
<h2 style="color:dimgray;">Logbook for Raman Microscope in lab. 3304</h2>

<?php
	include 'fn_message.php';

//	echo '<center>';
	
//-------------------------------------------------------------------
// list previous months
	if(!$handle=fopen("logbooks/raman_3304.log","r"))
	{
		message("An error occurred.");
		exit;
	}
//	$bg = "moccasin";
	$line = fgets($handle);
	$head = date('F Y', strtotime($line));
	while (!feof($handle))
	{
		echo '<hr>';
		echo '<h3 style="color:dimgray;">'.$head.'</h3>';
		echo '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=1 WIDTH="65%">';
		echo '<TR ALIGN="center" VALIGN="middle" style="background-color:deepskyblue;">';

		echo '<TH>Date</TH>';
		echo '<TH>Operator</TH>';
		echo '<TH>Laser</TH>';
		echo '<TH>Sample</TH>';
		echo '<TH>Comment</TH>';
		echo '</TR>';
	

		while (1==1)
		{
			$line=fgets($handle);
//			if ($line=="") {break;}
			$parts=explode(";",$line);
			if ($parts[1]=="") {$head = date('F Y', strtotime($line));break;}

			echo '<TR style="background-color:moccasin">';
			echo '<TD style="width:12%">' .$parts[0] . '</TD>';
//			echo '<TD>' .$parts[0] . '</TD>';
			echo '<TD>' .$parts[1] . '</TD>';
			echo '<TD>' .$parts[2] . '</TD>';
			echo '<TD>' .$parts[3] . '</TD>';
			echo '<TD>' .$parts[4] . '</TD>';
			echo '</TR>';
		}
		echo '</TABLE><br />';
	}
	fclose($handle);

?>
</BODY>
</HTML>

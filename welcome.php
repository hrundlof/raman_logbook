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
	$id = $_REQUEST['id'];
	$user = $_REQUEST['user'];

	if (time() > intval($id,16) || (time()+1200) < intval($id,16))
	{
		header ("Location: logout.php");  // which saves the data
	exit;
	}


//--------------------------------------------------------------------------
// Current month
//	$month=date('F Y', time());
	$idag = date('Y-m-d', time());

	if(!$handle=fopen("logbooks/this_month.log","r"))
	{
		message("An error occurred.");
		exit;
	}
// read first line which is the current month in format 2016-01 and convert to January 2016

	$line=fgets($handle);
	$month = date('F Y', strtotime($line));
	echo '<h3 style="color:dimgray;">'.$month.'</h3>';
	
	echo '<form action="save_buffer.php">';

	echo '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=1 WIDTH="65%">';
	echo '<TR ALIGN="center" VALIGN="middle" style="background-color:deepskyblue;">';

	echo '<TH>Date</TH>';
	echo '<TH>Operator</TH>';
	echo '<TH>Laser</TH>';
	echo '<TH>Sample</TH>';
	echo '<TH>Comment</TH>';
	echo '</TR>';

	

	while (!feof($handle))
	{
		$line=fgets($handle);
		if ($line=="") {break;}
		$parts=explode(";",$line);

		echo '<TR style="background-color:lightyellow">';
		echo '<TD style="width:12%">' .$parts[0] . '</TD>';
//		echo '<TD>' .$parts[0] . '</TD>';
		echo '<TD>' .$parts[1] . '</TD>';
		echo '<TD>' .$parts[2] . '</TD>';
		echo '<TD>' .$parts[3] . '</TD>';
		echo '<TD>' .$parts[4] . '</TD>';
		echo '</TR>';
	}
	fclose($handle);
//--------------------------------------------------------------------------
// read buffer and display in table
	if(!$handle=fopen("logbooks/buffer.log","r"))
	{
		message("An error occurred.");
		exit;
	}
	while (!feof($handle))
	{
		$line=fgets($handle);
		if ($line=="") {break;}
		$parts=explode(";",$line);

		echo '<TR style="background-color:lightgreen">';
		echo '<TD style="width:12%">' .$parts[0] . '</TD>';
//		echo '<TD>' .$parts[0] . '</TD>';
		echo '<TD>' .$parts[1] . '</TD>';
		echo '<TD>' .$parts[2] . '</TD>';
		echo '<TD>' .$parts[3] . '</TD>';
		echo '<TD>' .$parts[4] . '</TD>';
		echo '</TR>';
	}
	fclose($handle);

// input fields
	echo '<TR  ALIGN="center" style="background-color:lightgreen">';
	echo '<TD> <input type="text" size="12" name="dag" maxlength="10" placeholder="YYYY-MM-DD" value="'.$idag.'" required> </TD>';
	echo '<TD> <input type="text" size="12" name="user" maxlength="20" placeholder="Operator" value="'.$user.'" required> </TD>';
	echo '<TD> <input type="text" size="12" name="laser" maxlength="15" placeholder="Laser" required> </TD>';
	echo '<TD> <input type="text" size="17" name="sample" maxlength="20" placeholder="Sample" required> </TD>';
//	echo '<TD> <input type="text" size="60" name="comment" placeholder="Comment" required> </TD>';
	echo '<TD> <textarea cols="55" rows="2" name="comment" placeholder="Comment" required></textarea> </TD>';
	echo '</TR>';
	echo '</TABLE>';
	echo '<input type="hidden" name="id" value="'.$id.'">';
//	echo '<input type="hidden" name="user" value="'.$user.'">';
	echo '<br /><input style="font-size:16px" type="submit" value=" Save ">';
	echo '</form>';

// undo button
	echo '</center>';
	echo '<form action="undo.php">';
	echo '<div style="width:16%;margin:2% 0% 2% 42%;padding:1px 0px 1px 1px;border:0px solid;">';
	echo '<input style="font-size:16px" type="submit" value=" Undo ">';
	echo '<input type="hidden" name="id" value="'.$id.'">';
	echo '<input type="hidden" name="user" value="'.$user.'">';
	echo '</form>';

// logout button	
	echo '<div style="float:right;border:0px solid">';
	echo '<form action="logout.php">';
	echo '<input style="font-size:16px" type="submit" value=" Logout ">';
	echo '</form>';
	echo '</div>';
	
	echo '</div>';
	echo '<div style="color:dimgray;width:35%;margin:2% 0% 2% 60%;padding:1px 0px 1px 10px;border:0px solid;">';
	echo 'Håkan Rundlöf, Dep. of Chemistry, UU<br/>';
	echo "<a href='email_address.php?user=$user&id=$id'>About notifications</a>";
	echo '</div>';

	echo '<center>';
	
//-------------------------------------------------------------------
// list previous month
	if(!$handle=fopen("logbooks/prev_month.log","r"))
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
<a href="showall.php" target="_blank">View older logs </a> (opens in new window)<br /><br />
</BODY>
</HTML>

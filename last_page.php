<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Raman Logbook</TITLE>
<META NAME="Generator" CONTENT="">
<meta http-equiv="refresh" content="2">
<META NAME="Author" CONTENT="hr">
<META NAME="Keywords" CONTENT="?">
<META NAME="Description" CONTENT="?">
</HEAD>

<BODY style="background-color:lightblue;font: 18px arial, sans-serif;">

<center><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<h2 style="color:dimgray;">
Have a nice day!
</h2>

<?php
$timeout = $_REQUEST['timeout'];

if (time() > intval($timeout,16))
{
	header ("Location: index.htm");
}


?>

</BODY>
</HTML>
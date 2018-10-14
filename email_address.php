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

<BODY style="background-color:powderblue;font: 15px arial, sans-serif;">
<center>
<h2 style="color:dimgray;">Raman Microscope</h2>
<h3 style="color:dimgray;">
If the comment, entered by the operator, has more than 10 characters<br/> a message is sent to the e-mail address below
</h3>
</center>
<hr>
<br/>
<div style="background-color:deepskyblue;width:25%;margin:0% 0% 0% 35%;padding:5px 5px 0px 30px;border:1px solid;">

<?php
	$id = $_REQUEST['id'];
	$user = $_REQUEST['user'];
	if ($id == "")
	{
		header ("Location: index.htm");
		exit;
	}
	$email = file_get_contents("logbooks/email_address.txt");
	echo "<form action='save_email.php'><br/>";
	echo "E-mail address <br/><input type='text' size='40' name='email' placeholder='$email' required><br/><br/>";
	echo "Password <br/><input type='password' size='18' name='psw' placeholder='Same as login'>";
	echo "<input type='hidden' name='id' value='$id'>";
	echo "<input type='hidden' name='user' value='$user'>";
?>
<div style="float:right;">
<input style="font-size:15px" type="submit" value="Update">
</div>
</form>
</div>
<br/>
<center>
<form action="javascript:history.back()">
<input style="font-size:16px" type="submit" name="no" value="Cancel">
</form>
</center>
</BODY>
</HTML>

<?php 
// Logout
include 'fn_message.php';

$buf = file_get_contents("logbooks/buffer.log");

if ($buf != "")
{
	$month = file_get_contents("logbooks/this_month.log");

	file_put_contents("logbooks/this_month.log", $month.$buf);
	
	file_put_contents("logbooks/buffer.log","");
}

header ("Location: last_page.php?timeout=".sprintf("%x",time() + 1));

// header ("Location: index.htm");

?>
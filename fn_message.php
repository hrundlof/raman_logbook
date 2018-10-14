<?php

   function message($mess)
   {
//   Pop-up alerts are not always supported. Do not use it
//   echo "<script type=\"text/javascript\">";
//   echo "alert('$mess');";
//   echo "history.back();";
//   echo "</script>";

   echo "<h2><center><br /><br /><br /><br />";
   echo $mess;
   echo "<br /><br />";
   echo '<a href="javascript:history.back()">Go back</a>';
   echo "</center></h2>";

   return;
   }
?>

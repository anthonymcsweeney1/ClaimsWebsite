<?php 
session_save_path("Claims/sess_save");
session_start();
/*Start the Session Process*/
echo $_SESSION["session_name"];
/*Output : session value */
?>

<?php 
session_start();

session_destroy();
	
	echo '<script language = javascript>
	
	self.location = "../index.php";
	</script>';

?>
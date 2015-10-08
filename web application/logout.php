<?php 
	session_start();
	session_destroy();
   	$_SESSION['is_open'] = FALSE;
	header( "refresh:1;url=index.php" );
?>
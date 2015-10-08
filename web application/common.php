<?php
	$dburl = 'cs4111.cievuwypzozw.us-west-2.rds.amazonaws.com';
	$dbuser = 'xw2344';
	$dbpassword = 'mw2971mw2971';
	$dbname = 'cs4111';
	$conn = mysqli_connect($dburl,$dbuser,$dbpassword,$dbname);
	if (mysqli_connect_error()) {
	    die("Database connection failed: " . mysqli_connect_error());
	}
	ini_set('display_errors', 'On');
?>
<?php
	require_once "common.php";
	session_start();
	
	$name = $_POST["real_name"];
	$username = $_POST["user_name"];
	$address = $_POST["home_adress"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$profilepic = $_POST["profile_pic"];
	$password = md5($_POST["password"]);
	$password2 = md5($_POST["password_confirmation"]);
	
	//to-do: check password confirmation
	
	//insert new post
	$insertstmt="INSERT INTO user (user_name, password, name, email, address, telephone, profile_picture) VALUES ('$username','$password','$name','$email','$address','$phone','$profilepic')";
	mysqli_commit($conn);
	if(!mysqli_query($conn,$insertstmt)){

		//to-do: change error message
		echo("SQL Error!");
	}
		
	mysqli_close($conn);
	$_SESSION["login_user"] = $username;
	$_SESSION['is_open'] = TRUE;
	echo "<B>".$username." successfully registered!"."</B>";
	echo "\nYou will be redirected to the log in page in a moment.";

	echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
?>
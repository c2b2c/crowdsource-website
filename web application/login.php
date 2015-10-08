<?php  
	require_once "common.php";
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
	//username: demo
	//password: 123
	//tutorial on user session: http://www.w3schools.com/php/php_sessions.asp
	
	$myusername= $_POST['username']; 
	$mypassword= $_POST['password']; 
	$password_hash = md5($mypassword);

	$stmt= "SELECT user_id FROM user WHERE user_name='$myusername' and password='$password_hash'";
	
	
	$query=mysqli_query($conn,$stmt);
	$count=mysqli_num_rows($query);
	$row=mysqli_fetch_array($query);
	
  
        if($count == 1 ) {
            echo "You have successfully logged in.";
            $_SESSION['login_user'] = $myusername;
            $_SESSION['is_open'] = TRUE;
        } else {
            echo "Invalid login information."; 
        }
	
	mysqli_close($conn);
	}
	echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
?>
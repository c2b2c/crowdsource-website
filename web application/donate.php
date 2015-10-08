<?php
   	session_start();
	require_once "common.php";

	$projectid = $_GET['projectid'];
	$resourceid = $_GET['resourceid'];
	$postid = $_GET['postid'];
	$amount = $_POST["amount"];
	$supporter_id = $_SESSION["login_user"];
	$create_date = date("Y-m-d H:i:s");

	//get user id
	$userstmt = "SELECT * FROM user WHERE user_name= '$supporter_id'";

 	$user_info =mysqli_query($conn,$userstmt);

	if ($user_info->num_rows > 0) {
	    // output data of each row
	    while($row = $user_info->fetch_assoc()) {
	    	$user_id = $row['user_id'];

			//echo "</div>";
	    }
	} else {
	    echo "No such user!";
	}

	//insert into offers
	echo $create_date;
	echo "<br>";
	echo $user_id;
	echo "<br>";
	echo $projectid;
	echo "<br>";
	echo $resourceid;
	echo "<br>";
	echo $amount;
	echo "<br>";
	$insertstmt="INSERT INTO offers (offer_time, user_id, project_id, resource_id, quantity) VALUES ('$create_date','$user_id','$projectid', '$resourceid', '$amount')";
	
	if(!mysqli_query($conn,$insertstmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		echo "<h3> You just supported this project! <h3>";
	}
	mysqli_commit($conn);

	mysqli_close($conn);

	echo "postid";
	//echo "<script>setTimeout(\"location.href = 'article.php?postid=" . $postid . "';\",1500);</script>";
?>

<!-- CREATE TABLE make_comment(
	comment_id INT(9) AUTO_INCREMENT,
	comment_time TIMESTAMP,
	user_id INT(9) NOT NULL,
	content TEXT ,
	PRIMARY KEY (comment_id),
	FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE); -->
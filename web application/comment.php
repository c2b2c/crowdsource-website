<?php
   	session_start();
	require_once "common.php";

	$postid = $_GET['postid'];
	$commentcontent = $_POST["commentcontent"];
	$comment_user = $_SESSION["login_user"];
	$create_date = date("Y-m-d H:i:s");

	//get user id
	$userstmt = "SELECT * FROM user WHERE user_name= '$comment_user'";

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

	//insert new comment
	$insertstmt="INSERT INTO make_comment (comment_time, user_id, content) VALUES ('$create_date','$user_id','$commentcontent')";
	
	if(!mysqli_query($conn,$insertstmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		//echo "<h3> Your comment is posted! <h3>";
	}
	mysqli_commit($conn);

	//get comment_id
	$commentid_query = "SELECT comment_id FROM make_comment WHERE user_id='$user_id' AND content ='$commentcontent'"; 

	$commentidinfo =mysqli_query($conn,$commentid_query);

	if ($commentidinfo->num_rows > 0) {
	    // output data of each row
	    while($row = $commentidinfo->fetch_assoc()) {
	    	$comment_id = $row['comment_id'];
	    }
	} else {
	    echo "No such comment!";
	    echo $comment_id;
	}


	$comment_on_stmt="INSERT INTO comment_on (post_id, comment_id) VALUES ('$postid', '$comment_id')";
	
	if(!mysqli_query($conn,$comment_on_stmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		echo "<h3> Your comment is posted! <h3>";
	}
	mysqli_commit($conn);
		
	mysqli_close($conn);

	echo "<script>setTimeout(\"location.href = 'article.php?postid=" . $postid . "';\",1500);</script>";
?>

<!-- CREATE TABLE make_comment(
	comment_id INT(9) AUTO_INCREMENT,
	comment_time TIMESTAMP,
	user_id INT(9) NOT NULL,
	content TEXT ,
	PRIMARY KEY (comment_id),
	FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE); -->
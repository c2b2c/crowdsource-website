<?php
   session_start();
?>

<html>
<body>

<?php
	require_once "common.php";
	$title = $_POST["articletitle"];
	$image = $_POST["imageurl"];
	$articlecontent = $_POST["articlecontent"];
	$project_id = $_POST["project"];

	$create_date = date("Y-m-d H:i:s");
	//insert new post
	$insertstmt="INSERT INTO article_post (image, post_time, title, article) VALUES ('$image','$create_date','$title','$articlecontent')";
	
	
	if(!mysqli_query($conn,$insertstmt)){
		echo("SQL Error!");
	}
	mysqli_commit($conn);

	$postid_query = "SELECT post_id FROM article_post WHERE image='$image' AND title ='$title'"; 

	$postidinfo =mysqli_query($conn,$postid_query);

	if ($postidinfo->num_rows > 0) {
	    // output data of each row
	    while($row = $postidinfo->fetch_assoc()) {
	    	$post_id = $row['post_id'];
	    }
	} else {
	    echo "No such post!";
	}

	$postonstmt="INSERT INTO post_on(project_id, post_id) VALUES ('$project_id', '$post_id')";
	
	if(!mysqli_query($conn,$postonstmt)){
		echo("SQL Error!" . mysqli_error($conn) );
	}
	else{
		echo "<h3> Your article \"<?php echo $title; ?> \"is successfully posted! <h3>";
	}
		
	mysqli_commit($conn);

	mysqli_close($conn);

	
	echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
?>



</body>
</html>


<!-- CREATE TABLE post_on (
	project_id INT(9) NOT NULL,
	post_id INT(9),
	PRIMARY KEY (post_id),
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	FOREIGN KEY (post_id) REFERENCES article_post (post_id) ON DELETE CASCADE); -->

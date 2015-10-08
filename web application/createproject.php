<?php
   session_start();
?>

<html>
<body>

<?php
	require_once "common.php";

	$create_date = date("Y-m-d H:i:s");
	$projectname = $_POST["projectname"];
	$website_url = $_POST["websiteurl"];
	$summary = $_POST["projectsummary"];
	$status = $_POST["status"];
	$category = $_POST["category"];
	$user_name= $_SESSION["login_user"];

	//get user id
	$userstmt = "SELECT * FROM user WHERE user_name= '$user_name'";

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
	
	//insert new project
	$insertstmt="INSERT INTO project (status, name, website_url, summary, category) VALUES ('$status','$projectname','$website_url','$summary', '$category')";
	mysqli_commit($conn);
	if(!mysqli_query($conn,$insertstmt)){
		echo("SQL Error!");
	}
	else{
		//echo "<h3> Your project is successfully created! <h3>";
		//echo "<h3> Redirecting... <h3>";
	}
		
	//get project id
	$projectid_query = "SELECT project_id FROM project WHERE name='$projectname' AND website_url ='$website_url'"; 

	$projectidinfo =mysqli_query($conn,$projectid_query);

	if ($projectidinfo->num_rows > 0) {
	    // output data of each row
	    while($row = $projectidinfo->fetch_assoc()) {
	    	$project_id = $row['project_id'];
	    }
	} else {
	    echo "No such comment!";
	    echo $project_id;
	}

	mysqli_close($conn);
	echo "<script>setTimeout(\"location.href = 'askfor.php?project_id=" . $project_id . "';\",500);</script>";

	// $insertstmtpublish= "INSERT INTO publish (project_id, user_id, publish_time) VALUES ('$project_id','$user_id','$create_date')";
	// mysqli_commit($conn);
	// if(!mysqli_query($conn,$insertstmtpublish)){
	// 	echo("SQL Error!");
	// }
	// else{
	// 	//echo "<h3> Your project is successfully created! <h3>";
	// 	echo "<h3> Redirecting... <h3>";
	// }
?>

<!-- 	project_id INT(9),
	user_id INT(9) NOT NULL,
	publish_time TIMESTAMP,
 -->
</body>
</html>

<!-- CREATE TABLE project (
	project_id INT(9) AUTO_INCREMENT,
	status VARCHAR(10) NOT NULL,
	name VARCHAR(60) NOT NULL,
	website_url VARCHAR(200),
	summary TEXT,
	category VARCHAR(50),
	PRIMARY KEY (project_id),
	CHECK (status = 'open' OR status = 'closed'));

CREATE TABLE publish(
	project_id INT(9),
	user_id INT(9) NOT NULL,
	publish_time TIMESTAMP,
	PRIMARY KEY (project_id),
	FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE,
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE); -->
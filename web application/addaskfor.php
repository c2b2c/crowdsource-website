<?php
   	session_start();
	require_once "common.php";

	$project_id = $_GET['project_id'];
	$resourcename = $_POST["resourcename"];
	$quantity = $_POST["quantity"];
	$description = $_POST["description"];
	$create_date = date("Y-m-d H:i:s");

	// CREATE TABLE resource (
	// resource_id INT(9) AUTO_INCREMENT,
	// category VARCHAR(50),
	// description TEXT,
	// PRIMARY KEY (resource_id));

	//insert new resource
	$insertstmt="INSERT INTO resource (category, description) VALUES ('$resourcename','$description')";
	
	if(!mysqli_query($conn,$insertstmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		//echo "<h3> Your comment is posted! <h3>";
	}
	mysqli_commit($conn);

	//get resourceid
	$resourceid_query = "SELECT resource_id FROM resource WHERE description='$description'"; 

	$resourceidinfo =mysqli_query($conn,$resourceid_query);

	if ($resourceidinfo->num_rows > 0) {
	    // output data of each row
	    while($row = $resourceidinfo->fetch_assoc()) {
	    	$resource_id = $row['resource_id'];
	    }
	} else {
	    echo "No such comment!";
	    echo $resource_id;
	}

	// CREATE TABLE askfor(
	// project_id INT(9) NOT NULL,
	// resource_id INT(9) NOT NULL,
	// quantity INTEGER,
	// PRIMARY KEY (project_id,resource_id),
	// FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	// FOREIGN KEY (resource_id) REFERENCES resource (resource_id) ON DELETE CASCADE,
	// CHECK (quantity > 0));

	$addaskforstmt="INSERT INTO askfor (project_id, resource_id, quantity) VALUES ('$project_id', '$resource_id', '$quantity')";
	
	if(!mysqli_query($conn, $addaskforstmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		echo "<h3> Askfor is added! <h3>";
	}
	mysqli_commit($conn);
		
	mysqli_close($conn);

	echo "<script>setTimeout(\"location.href = 'options.php?project_id=" . $project_id . "';\",1500);</script>";
?>

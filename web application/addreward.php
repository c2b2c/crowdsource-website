<?php
   	session_start();
	require_once "common.php";

	$project_id = $_GET['project_id'];
	$rewardname = $_POST["rewardname"];
	$quantity = $_POST["quantity"];
	$description = $_POST["description"];
	$deliverymethod = $_POST["deliverymethod"];
	$create_date = date("Y-m-d H:i:s");

	 // CREATE TABLE reward(
  // reward_id INT(9) AUTO_INCREMENT,
  // type VARCHAR(50),
  // description TEXT,
  // PRIMARY KEY (reward_id)); 

	//insert new resource
	$insertstmt="INSERT INTO reward (type, description) VALUES ('$rewardname','$description')";
	
	if(!mysqli_query($conn,$insertstmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		//echo "<h3> Your comment is posted! <h3>";
	}
	mysqli_commit($conn);

	//get resourceid
	$resourceid_query = "SELECT reward_id FROM reward WHERE description='$description'"; 

	$resourceidinfo =mysqli_query($conn,$resourceid_query);

	if ($resourceidinfo->num_rows > 0) {
	    // output data of each row
	    while($row = $resourceidinfo->fetch_assoc()) {
	    	$reward_id = $row['reward_id'];
	    }
	} else {
	    echo "No such comment!";
	    echo $reward_id;
	}

  // CREATE TABLE payback(
  // project_id INT(9) NOT NULL,
  // reward_id INT(9) NOT NULL,
  // quantity_per_supporter INTEGER,
  // delivery_method VARCHAR(50),
  // PRIMARY KEY (project_id, reward_id),
  // FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
  // FOREIGN KEY (reward_id) REFERENCES reward (reward_id) ON DELETE CASCADE,
  // CHECK (quantity_per_supporter > 0));

	$addaskforstmt="INSERT INTO payback (project_id, reward_id, quantity_per_supporter, delivery_method) VALUES ('$project_id', '$reward_id', '$quantity', '$deliverymethod ')";
	
	if(!mysqli_query($conn, $addaskforstmt)){
		echo("SQL Error!" . mysqli_error($conn));
	}
	else{
		echo "<h3> Reward is added! <h3>";
	}
	mysqli_commit($conn);
		
	mysqli_close($conn);

	echo "<script>setTimeout(\"location.href = 'options2.php?project_id=" . $project_id . "';\",1500);</script>";
?>

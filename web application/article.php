<html>
<body>
	<!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
<?php
   session_start();
?>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prowdsourcing</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">

</head>
<body>
<!-- Navigation -->
    <nav class="navbar navbar-default " role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> <font size="7">Prowdsourcing</font> </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                     <!-- in/out-of session nav bar.  Do not change -->
                    <?php
                      if($_SESSION['is_open']){ 
                        echo "<li> <a href=\"#\"> Welcome ". $_SESSION["login_user"] . "!   </a> </li>"; 
                        echo "<li> <a href=\"logout.php\"> Log out</a> </li>";
                        echo "<li> <a href=\"userprofile.php?username=" . $_SESSION["login_user"] . "\"> Account </a> <li>" ;
                        echo "<li> <a href=\"createproject.html\"> Create Project</a> <li>";
                        echo "<li> <a href=\"post.php\"> Create Post</a> <li>";
                      }
                      else{ ?>
                      <!-- HTML here -->
                       <li> <a href="register.html" >Sign up</a> </li>
                       <li> <a href="login.html">Log in</a>  <li>

                     <?php } ?>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
        <hr class="colorgraph">
    </nav>
    <br>
    <br>
<div row>
<div class="col-lg-8">

<?php 
	require_once "common.php";

 	$postid = $_GET['postid'];

 	$poststmt = "SELECT * FROM article_post WHERE post_id= '$postid'";

 	$post_info =mysqli_query($conn,$poststmt);

 	$login_user = $_SESSION["login_user"];

	if ($post_info->num_rows > 0) {
	    // output data of each row
	    while($row = $post_info->fetch_assoc()) {
	    	$title = $row['title'];
	    	$post_time = $row['post_time'];
	    	$image = $row['image'];
	    	$article = $row['article'];

			//echo "<div class=\"container\">";
	    	echo "<h2> " . $title . "</h2>";
	    	echo "<hr>";
	    	echo "<p><span class=\"glyphicon glyphicon-time\"></span> Posted on " . $post_time . "</p>";
	    	echo "<hr>";
    		echo "<img class=\"media-object\" height = \"600\" width= \"750\" src=\" " . $image . "\"/>";
  			echo "<hr>";
    		
          	echo "<p>" . $article . "</p>";

			//echo "</div>";
	    }
	} else {
	    echo "No such post!";
	}

	echo "<hr>";
	//comment
	$commentstmt = "SELECT * FROM comment_on NATURAL JOIN make_comment NATURAL JOIN user WHERE post_id = '$postid'";
	$comment_info =mysqli_query($conn,$commentstmt);

	if ($comment_info->num_rows > 0) {
	    // output data of each row
	  
	    while($row = $comment_info->fetch_assoc()) {

	    	$comment_time = $row['comment_time'];
	    	$content = $row['content'];
	    	$comment_username = $row['user_name'];
	    	$commenter_pic = $row['profile_picture'];

	    	echo "<div class=\"media\">";
            echo "<a class=\"pull-left\" href=\"#\">";
            echo "<img class=\"media-object\" height = \"64\" width= \"64\" src=\"" . $commenter_pic . "\" alt=\"profile picture\">";
            echo "</a>";
            echo "<div class=\"media-body\">";
            echo "<h4 class=\"media-heading\">" . $comment_username . " <small> " . $comment_time . "</small></h4>";
            echo $content;
            echo "</div> </div>";

	    	//echo "Comments:";
			//echo " <br>";
			//echo " <br>";
			//echo "comment_time: " . $comment_time . "<br>";
			//echo "content: " . $content . "<br>";
			//echo "comment_username: " . $comment_username . "<br>";

	    }
	} else {
	    echo "No comment!";
	} ?>

	<!-- make comment -->

	<hr>
	<div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" action="comment.php?postid=<?php echo $postid;  ?>"  method="POST">
            <div class="form-group">
	          <textarea type="text" name="commentcontent" class="form-control" id="commentcontent" placeholder="Enter your comment on this article!" rows="4"> </textarea>
	        </div>
            <button type="submit" class="btn btn-primary">Comment!</button>
        </form>
    </div>


</div> <!-- col-lg-8 -->
<div class="col-md-4">
	<?php

	//echo "<br>";

	$projectstmt = "SELECT project_id, status, name, website_url, summary, category FROM project NATURAL JOIN post_on WHERE post_id = '$postid'";
	$project_info =mysqli_query($conn,$projectstmt);

	if ($project_info->num_rows > 0) {
	    // output data of each row
	  
	    while($row = $project_info->fetch_assoc()) {

	    	$project_id = $row['project_id'];
	    	$status = $row['status'];
	    	$name = $row['name'];
	    	$website_url = $row['website_url'];
	    	$summary = $row['summary'];
	    	$category = $row['category'];
	    	$website_url = $row['website_url'];

	    	echo "<div class=\"well well-sm\">";
            echo " <div class=\"row\">";
            echo "<div class=\"col-xs-9 col-md-9 section-box\">";
            echo " <a href=\"" . $website_url .  " \" > <h2> " .  $name . " </h2> </a> ";
            echo " <p> " . $summary . "</p> ";
            echo " <p> category: " . $category . "</p> ";
            echo " <p> status: " . $status . "</p> ";
            echo "</div> </div> </div>";
            echo "<hr /> ";
                        
                   
			//echo "Project Info:";
			//echo " <br>";
			//echo " <br>";
			//echo "project_id: " . $project_id . "<br>";
			//echo "status: " . $status . "<br>";
			//echo "name: " . $name . "<br>";
			//echo "website_url: " . $website_url . "<br>";
			//echo "summary: " . $summary . "<br>";
			//echo "category: " . $category . "<br>";
	    }
	} else {
	    echo "No such project!";
	}

	//echo "<br>";

	//donate info
	$askforstmt = "SELECT * FROM askfor NATURAL JOIN resource WHERE project_id = '$project_id'";
	$askfor_info =mysqli_query($conn,$askforstmt);

	echo "<div class=\"well well-sm\">";
    echo " <div class=\"row\">";
    echo "<div class=\"col-xs-9 col-md-9 section-box\">";
    echo "<h3> The publisher of this project is asking for: </h3>";

	if ($askfor_info->num_rows > 0) {
	    // output data of each row
	 
	//  CREATE TABLE offers (
	// user_id INT(9) NOT NULL,
	// project_id INT(9) NOT NULL,
	// resource_id INT(9),
	// quantity INTEGER,
	// offer_time TIMESTAMP,
	// PRIMARY KEY (user_id, project_id, resource_id, offer_time),
	// FOREIGN KEY (resource_id) REFERENCES resource (resource_id) ON DELETE CASCADE,
	// CHECK (quantity > 0)); 
	  	
	    while($row = $askfor_info->fetch_assoc()) {

	    	$category = $row['category'];
	    	$description = $row['description'];
	    	$quantity = $row['quantity'];
	    	$donate_resource_id = $row['resource_id'];
	    	echo "<h4 class=\"product-name\"><b>Category : " . $category . "</b></h4><h4><small> " . $description . "
							<br />
							total amount needed : " .  $quantity . "</small></h4>";

			// echo " <input type=\"text\" class=\"form-control input-sm\" value=\"1\"> ";
			// echo "<button type=\"button\" class=\"btn btn-link btn-xs\"> Support! </button>";

			echo " <form role=\"form\" action=\"donate.php?projectid=" . $project_id . "&resourceid=" . $donate_resource_id . "&postid=" . $postid . "\" method=\"POST\">";
            echo "<div class=\"form-group\">";
	        echo "<input type=\"text\" name=\"amount\" class=\"form-control input-lg\" id=\"quantity\" placeholder=\"Amount\"> </input>";
	        echo "</div>";
            echo "<button type=\"submit\" class=\"btn btn-primary\">Support!</button>";
       		echo "</form>";
	    	//echo "Ask for info:";
			//echo " <br>";
			//echo " <br>";
			//echo "category: " . $category . "<br>";
			//echo "description: " . $description . "<br>";
			//echo "quantity: " . $quantity . "<br>";

	    }
	    
	} else {
	    echo "Ask for nothing!";
	}
	echo "</div> </div> </div>";
    echo "<hr /> ";


	//echo "<br>";

	$rewardstmt = "SELECT * FROM project NATURAL JOIN payback NATURAL JOIN reward WHERE project_id = '$project_id'";
	$reward_info =mysqli_query($conn,$rewardstmt);

	echo "<div class=\"well well-sm\">";
    echo " <div class=\"row\">";
    echo "<div class=\"col-xs-9 col-md-9 section-box\">";
    echo "<h3> Reward for Supporters: </h3>";


	if ($reward_info->num_rows > 0) {
	    // output data of each row
	  
	  
	    while($row = $reward_info->fetch_assoc()) {

	    	$reward_type = $row['type'];
	    	$reward_description = $row['description'];
	    	$quantity_per_supporter = $row['quantity_per_supporter'];
	    	$delivery_method = $row['delivery_method'];
	    	echo "<table class=\"table table-hover\">";
            echo "        <thead>";
            echo "            <tr> ";
            echo "                <th>Type</th> ";
            echo "               <th>Quantity per Supporter</th> ";
            echo "               <th class=\"text-center\">reward_description </th> ";
            echo "                <th class=\"text-center\">delivery method</th> ";
            echo "            </tr> ";
            echo "        </thead> ";
            echo "        <tbody>";
            echo "           <tr>";
            echo "                <td class=\"col-md-9\"><em> " . $reward_type . "</em></h4></td>";
            echo "                <td class=\"col-md-1\" style=\"text-align: center\"> " . $quantity_per_supporter . " </td>";
            echo "                <td class=\"col-md-1 text-center\">" . $reward_description . " </td>";
            echo "                <td class=\"col-md-1 text-center\">" . $delivery_method . " </td> ";
            echo "            </tr>";
            echo "        </tbody>";
            echo " </table>";

	    	//echo "Reward:";
			//echo " <br>";
			//echo " <br>";
			//echo "reward_type: " . $reward_type . "<br>";
			//echo "reward_description: " . $reward_description . "<br>";
			//echo "quantity_per_supporter: " . $quantity_per_supporter . "<br>";
			//echo "delivery_method: " . $delivery_method . "<br>";

	    }

	    
	} else {
	    echo "No reward!";
	}

	echo "</div> </div> </div>";
    echo "<hr /> ";

	$supporterstmt = "SELECT * FROM user U, offers O, project P, resource R WHERE U.user_id = O.user_id AND O.project_id = P.project_id AND O.resource_id = R.resource_id AND P.project_id = '$project_id' ";
	$supporterlist =mysqli_query($conn,$supporterstmt);

	//echo "Supporter:";
	//echo " <br>";
	//echo " <br>";

  	echo "<div class=\"well well-sm\">";
    echo " <div class=\"row\">";
    echo "<div class=\"col-xs-9 col-md-9 section-box\">";
    echo "<h3> Supporters of this project: </h3>";
	if ($supporterlist->num_rows > 0) {
	    // output data of each row
	  

	    while($row = $supporterlist->fetch_assoc()) {

	    	$supporter_name = $row['user_name'];
	    	$resource_category = $row['category'];
	    	$resource_description = $row['description'];
	    	$resource_quantity = $row['quantity'];
	    	$offer_time = $row['offer_time'];

	    	echo "<table class=\"table table-condensed table-hover\">";
    		echo " <thead> ";
    		echo "		<tr>";
    		echo "			<th> </th>";
    		echo "			<th>Resource category</th> ";
    		echo "			<th>resource quantity</th> ";
    		echo "			<th>offer time</th>";
    		echo "		</tr> ";
    		echo "	</thead>";
    		echo "	<tbody>";
    		echo "		<tr>";
    		echo "			<td>" . $supporter_name . "</td>";
    		echo "			<td> " . $resource_category . " </td>";
    		echo "			<td> " . $resource_quantity . " </td>";
    		echo "			<td> " . $offer_time . " </td>";
    		echo "		</tr>";
    		echo "	</tbody> ";
    		echo "</table>";

			//echo "supporter_name: " . $supporter_name . "<br>";
			//echo "resource_category: " . $resource_category . "<br>";
			//echo "resource_description: " . $resource_description . "<br>";
			//echo "resource_quantity: " . $resource_quantity . "<br>";
			//echo "offer_time: " . $offer_time . "<br>";
			//echo "<br>";
	    }

	    
	} else {
	    echo "No Supporter!";
	}
	echo "</div> </div> </div>";
    echo "<hr /> ";
 	mysqli_close($conn);
?>

</div>
</div>
</body>
</html>

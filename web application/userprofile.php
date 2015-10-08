<?php
   session_start();
?>
<html>
<body>
	<!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

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
                <a class="navbar-brand" href="index.php"><font size="7">Prowdsourcing</font></a>
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
<?php 
	require_once "common.php";


 	$username = $_GET['username'];

 	//echo $username;

 	$stmt = "SELECT * FROM user WHERE user_name= '$username'";

 	$result =mysqli_query($conn,$stmt);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$realname = $row['name'];
	    	$email = $row['email'];
	    	$address = $row['address'];
	    	$telephone = $row['telephone'];
	    	$profilepic = $row['profile_picture']; 
	    	//echo "username: " . $username . "<br>";
			//echo "name: " . $realname . "<br>";
			//echo "email: " . $email . "<br>";
			//echo "address: " . $address . "<br>";
			//echo "telephone: " . $telephone . "<br>";
			//echo "profilepic:";
			//echo "<br>";
			//echo "<br>";
			//echo "<img src=\"" . $profilepic . "\">";
	    }
	} else {
	    echo "No user info";
	}

	
 	mysqli_close($conn);
?>
<br />
<br />
<br />
<br />
<div class="container">
    <div class="row">
        <div class="col-xs-24 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src=" <?php echo $profilepic; ?> " alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            <font size='7'> <?php echo $realname; ?></font></h4>
                            <br />
                        <small><cite title="location"> <font size='5'> <?php echo $address; ?> </font> </cite></small>
                        <p>
                            <br />
                            <br />
                            <font size='4'><?php echo $email; ?></font> 
                            <br />
                            <br />
                            <font size='4'> <?php echo $telephone; ?> </font> 
                            <br />
                            <br />
                            <font size='4'> <?php echo $username; ?> </p></font> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
	session_start();
  $project_id = $_GET['project_id'];
?>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ProwdSourcing</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><font size="7">Prowdsourcing</font>  </a>
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
    <br>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<p> Do you want to add more reward? </p>
<a href="reward.php?project_id=<?php echo $project_id;?>" class="btn btn-info" role="button">Yes</a>
<a href="index.php" class="btn btn-info" role="button">No</a>
</div>
</div>

</body>
</html>
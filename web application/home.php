<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">

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
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h3><a class="navbar-brand" href="index.php">Proudsourcing</a><h3>
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

    <!-- Page Content -->
    <br>

    <br>

    <br>

    <br>

    <br>

    <div class="container">

        <!-- Page Header -->
        <!-- <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Page Heading
                    <small>Secondary Text</small>
                </h1>
            </div>
        </div> -->
        <!-- /.row -->

        <?php
          require_once "common.php";

          $stmt = "SELECT * FROM project NATURAL JOIN post_on NATURAL JOIN article_post";

          $post_info = mysqli_query($conn,$stmt);

          $index = 0;

          if ($post_info->num_rows > 0) {
              // output data of each row
              while($row = $post_info->fetch_assoc()) {
                $post_id = $row['post_id'];
                $name = $row['name'];
                $title = $row['title'];
                $category = $row['category'];
                $image = $row['image'];

                if($index % 3 === 0){
                    echo " <div class=\"row\">";
                }
                echo " <div class=\"col-md-4 portfolio-item\"> \n";
                echo "<a href=\"article.php?postid=" . $post_id . "\" class=\"i-category-header\"> \n";
                echo " <img class=\"img-responsive\" src=\"" . $image . "\" alt=\"\"> \n";
                echo " <h4> " . $title . " </h4> </a> ";
                echo "</a>";
                echo "<p> " . $name . "</p>";
                echo "</div>";

                if($index % 3 === 2){
                    echo " </div>";
                    echo " <br> ";
                }
                $index++;
              }
          } else {
              echo "No post!";
          }

        ?>

       

        <hr>


       

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap.min.js"></script>

</body>

</html>
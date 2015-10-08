<?php
   session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="container">
      <h2>Add an Article Post</h2>
      <hr class="colorgraph">
      <form role="form" action="addpost.php" method="POST">
        <div class="form-group">
          
         <?php 

        require_once("common.php");
        
        $username = $_SESSION['login_user'];

        echo "<label for=\"selectproject\"> <h4> Hello " . $username . "! </h4> <br> Please choose the project you want to post an article on : </label>";

        $projectstmt = "SELECT DISTINCT PR.name, PR.project_id FROM user U, publish PU, project PR WHERE U.user_id = PU.user_id AND PR.project_id = PU.project_id AND U.user_name ='$username'";
        $project_info =mysqli_query($conn,$projectstmt);

        if ($project_info->num_rows > 0) {
            // output data of each row
            while($row = $project_info->fetch_assoc()) {
              $projectname= $row['name'];
              $projectid=$row['project_id'];
              echo "<label class=\"checkbox-inline\">";
              echo "<input type=\"radio\" id=\"inlineCheckbox\" name=\"project\" value=\"". $projectid . "\"> " . $projectname ;
              echo "</label>";
            }
        } else {
            echo "No project!";
        }

        mysqli_close($conn);
       ?>   </div>
        <div class="form-group">
          <label for="articletitle">Title</label>
          <input type="text" class="form-control" id="articletitle" placeholder="Enter title of your article post" name="articletitle">
        </div>
        <div class="form-group">
          <label for="imageurl">Image URL</label>
          <input type="text" name="imageurl" class="form-control" id="imageurl" placeholder="Enter Image URL">
        </div>
        <div class="form-group">
          <label for="articlecontent">Article Content</label>
          <textarea type="text" name="articlecontent" class="form-control" id="articlecontent" placeholder="Enter content of your article post" rows="10"> </textarea>
        </div>
          <hr class="colorgraph">
        <button type="submit" class="btn btn-default">Post!</button>
      </form>
    </div>
  </body>
</html>



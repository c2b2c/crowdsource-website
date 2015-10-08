<?php
  $project_id = $_GET['project_id'];
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
      <h2>Ask for Resources!</h2>
      <form role="form" action="addaskfor.php?project_id=<?php echo $project_id;?>" method="POST">
        <div class="form-group" >
          <hr class="colorgraph">
          <label for="resourcename">Resource Type</label>
          <input type="resourcename" name="resourcename" class="form-control" id="resourcename" placeholder="Enter Resource Type">
        </div>
        <div class="form-group">
          <label for="quantity">Amount You Are Asking For</label>
          <input type="quantity" name="quantity" class="form-control" id="quantity" placeholder="Enter Amount">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="description" name= "description" class="form-control" id="description" placeholder="Enter Description" rows="5"> </textarea>
        </div>
        <hr class="colorgraph">
        <button type="submit" class="btn btn-default">Next Step!</button>
      </form>
    </div>
  </body>
</html>
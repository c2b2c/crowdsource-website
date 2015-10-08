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
      <h2>Add Reward for Supporters!</h2>
      <form role="form" action="addreward.php?project_id=<?php echo $project_id;?>" method="POST">
        <div class="form-group" >
          <hr class="colorgraph">
          <label for="rewardname">Reward Type</label>
          <input type="rewardname" name="rewardname" class="form-control" id="rewardname" placeholder="Enter Resource Type">
        </div>
        <div class="form-group">
          <label for="quantity">Amount You Are Providing</label>
          <input type="quantity" name="quantity" class="form-control" id="quantity" placeholder="Enter Amount">
        </div>
        <div class="form-group" >
          <hr class="colorgraph">
          <label for="deliverymethod">Delivery Method</label>
          <input type="deliverymethod" name="deliverymethod" class="form-control" id="deliverymethod" placeholder="Enter Resource Type">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="description" name= "description" class="form-control" id="description" placeholder="Enter Description" rows="5"> </textarea>
        </div>
        <hr class="colorgraph">
        <button type="submit" class="btn btn-default">Next Step!</button>
      </form>
      <br>
      <a href="redirect.html" class="btn btn-default" role="button">No Reward</a>
    </div>
  </body>
</html>




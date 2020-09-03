



<?php

 include('config/db_connect.php');

$sql='SELECT name_of_donor,bloodgroup,email,id FROM donations ORDER BY created_at ';

$result=mysqli_query($conn,$sql); //connect to a particular table

$donations=mysqli_fetch_all($result,MYSQLI_ASSOC);   //fetch data from database in a form of array

mysqli_free_result($result);  //free the variables

mysqli_close($conn); //close connection

?>


<!DOCTYPE html>
<html>

<?php include('header.php'); ?>

	<div class="row  search">
		<form class="col s12" action="search.php" method="post">
			<div class="input-field col s6">
					<input name="q" placeholder="Enter blood Group" id="bloodgroup" type="text" class="validate">

					<!-- <label for="bloodgroup">Blood Group</label> -->
				</div>
				<button class="btn waves-effect waves-light searchbtn" type="submit" name="search">Search
					<!-- <i class="material-icons right">send</i> -->
				</button>
        <!-- <img src="red-blood.jpg" class="img" alt="blood"> -->
		</form>

	</div>

  <div class="container">
  <div class="row">

    <h4 class="center grey-text">Entries!</h4>

    <?php foreach($donations as $d){ ?>

      <div class="col s6 md3">
        <div class="card z-depth-0">
          <div class="card-content center">
            <h6><?php echo htmlspecialchars($d['name_of_donor']); ?></h6>
            <div><?php echo htmlspecialchars($d['bloodgroup']); ?></div>
          </div>
          <div class="card-action right-align">
            <a class="brand-text" href="details.php?id=<?php echo $d['id'] ?>">more info</a>
          </div>
        </div>
      </div>

    <?php } ?>
    <?php include('footer.php') ?>

</html>

<?php


	include('config/db_connect.php');


	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM donations WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}

	// check GET request id param
	if(isset($_GET['id'])){

		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM donations WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$donor = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">

	<?php include('header.php'); ?>

  <style type="text/css">
	.detail{
		background-color: #00bcd4;

	}
	.d{
		margin-left: 500px ;
		margin-right: 100px;
	}
	.a{
		margin-left: 50px;
	}
	</style>

  	<div class="container center d">
  		<?php if($donor): ?>

        <br>


				  <div class="row ">
				    <div class="col s12 m6">
				      <div class="card  detail darken-1">
				        <div class="card-content white-text">
				          <span class="card-title"><h4>Name of Donor: <?php echo $donor['name_of_donor']; ?></h4></span>
									<h6>Created By</h6>
									<p><?php echo $donor['email']; ?></p>
									<br>
									<p>Posted on</p>
									<p><?php echo date($donor['created_at']); ?></p>
									<br>
									<h6>Blood Group:</h5>
									<p><?php echo $donor['bloodgroup']; ?></p>
				        </div>
				        <div class="card-action">

				        </div>
				      </div>
				    </div>
				  </div>



        <form class="a" action="details.php" method="POST">
  				<input type="hidden" name="id_to_delete" value="<?php echo $donor['id']; ?>">
  				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
  			</form>
  		<?php else: ?>
  			<h5>No such donor exists.</h5>
  		<?php endif ?>
  	</div>


			<!-- DELETE FORM -->


  	<?php include('footer.php'); ?>
 </html>

<?php

 include('config/db_connect.php');
	$email = $name = $bloodgroup = '';
	$errors = array('email' => '', 'name' => '', 'bloodgroup' => '');

	if(isset($_POST['submit'])){

		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check title
		if(empty($_POST['name'])){
			$errors['name'] = 'A title is required';
		} else{
			$title = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['name'] = 'Title must be letters and spaces only';
			}
		}

    $bloodgrp = array("A+" ,"A POSITIVE","A NEGATIVE","B POSITIVE","B NEGATIVE","O POSITIVE","O NEGATIVE","AB POSITIVE","AB NEGATIVE","B+" ,"AB+" ,"O+" ,"A-" ,"B-" ,"AB-" ,"O-" ,"A" , "B" ,"AB" ,"O" );

		if(empty($_POST['bloodgroup'])){
			$errors['bloodgroup'] = 'Blood group is required';
		} else{
			$bloodgroup = $_POST['bloodgroup'];
      $bloodgroup=strtoupper("$bloodgroup");
			if(!in_array( $bloodgroup, $bloodgrp)){
				$errors['bloodgroup'] = 'Enter a valid entry';
			}
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
      $email=mysqli_real_escape_string($conn,$_POST['email']);
        $name=mysqli_real_escape_string($conn,$_POST['name']);

        $bloodgroup=mysqli_real_escape_string($conn,$_POST['bloodgroup']);
          // $bloodgroup=strtoupper("$bloodgroup");
			//echo 'form is valid';
      $sql="INSERT INTO donations(email,name_of_donor,bloodgroup) VALUES('$email','$name','$bloodgroup')";

      if(mysqli_query($conn,$sql))
      {
        header('Location: index.php');
      }
      else {
        // code...
        echo 'query error' . mysqli_error($conn);
      }


		}

	} // end POST check

?>

<!DOCTYPE html>
<html>

	<?php include('header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add your entry!!!</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>
			<label>Blood Group</label>
			<input type="text" name="bloodgroup" value="<?php echo htmlspecialchars($bloodgroup) ?>">
			<div class="red-text"><?php echo $errors['bloodgroup']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('footer.php'); ?>

</html>

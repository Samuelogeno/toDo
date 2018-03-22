<?php include("connection.php"); ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		body{
			background-image: url("img/img2.jpg.jpg");
		}
		
		.jumbotron{
			background-color: lavender;
		}
	</style>
</head>
<body>
	<!-- <button class="btn btn-info">skldj</button> -->
	<div class="container-fluid">
		<div class="jumbotron  text-center ">
			<h1 class="">REGISTER <span class="text-danger">TO</span>|DO</h1>
		</div>
		
		<div class="jumbotron main">
			<form class="form-horizontal" role="form" action="register.php" method="post">
				<div class="form-group">
					<label class="control-label col-sm-2 lead" for="user"><b>Username:</b></label>
					<div class="col-sm-10">
						<input type="text" name="user" class="form-control input-lg" id="user" placeholder="Enter username" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2 lead" for="tel"><b>Telephone:</b></label>
					<div class="col-sm-10">
						<input  type="text" name="phone" class="form-control input-lg" id="tel" placeholder="Enter telephone number" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2 lead" for="pwd"><b>Password:</b></label>
					<div class="col-sm-10">
						<input type="password" name="pass" class="form-control input-lg" id="pwd" placeholder="Enter password" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-info btn-lg" name="register" type="submit" class="btn btn-default">Register</button>
					</div>
				</div>
			</form>
			<h3 class="text-center"><a href="login.php"><b>Already have an account?Click here to login.</b></a></h3>
			<?php 
				if (isset($_POST['register'])) {
					extract($_POST);
					$hashedPassword=password_hash($pass,PASSWORD_DEFAULT);
					$add="INSERT INTO 6470users(USERNAME,PASSWORD_HASH,PHONE) VALUES('$user','$hashedPassword','$phone')";
					$query=mysqli_query($conn,$add);
					if (!$query) {
						?>
						<h2 class="text-center text-danger">User already exists,try another username</h2>
						<?php
						// die("The user exists".mysqli_error($conn));
						// header("Location:register.php");

					}else{
						?>
						<!-- <h2 class="text center text-success ">Welcome <?php echo $user; ?>your telephone number is <?php echo $phone; ?></h2> -->
						<?php
						$_SESSION['user']=$user;
						$_SESSION['phone']=$phone;
						$_SESSION['newuser']="true";
						$_SESSION['reset']="false";
						header("Location:dashboard.php");
					}
					
				}

			 ?>

		</div>
	</div>
</body>
</html>
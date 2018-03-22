<?php include("connection.php"); ?>
<?php session_start(); 
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login form</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
	body{
		background-image: url(img/work.jpg);
		background-position: center;

	}
	.container{
		margin-top: 10em;
	}

</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-1 col-sm-12"></div>
			<div class="col-md-10 col-sm-12">
				
					<div class="jumbotron reset">
						<h2 class="text-danger">PASSWORD RESET FORM</h2>
						<form class="form-horizontal" role="form" action="reset.php" method="post">
							<div class="form-group">
								<label class="control-label col-sm-2 lead" for="user"><b>Username:</b></label>
								<div class="col-sm-10">
									<input type="text" name="user" class="form-control input-lg" id="user" placeholder="Enter username" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 lead" for="tel"><b>Telephone:</b></label>
								<div class="col-sm-10">
									<input type="text" name="phone" class="form-control input-lg" id="tel" placeholder="Enter telephone number" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 lead" for="pwd"><b>Enter new password:</b></label>
								<div class="col-sm-10">
									<input type="password" name="pass" class="form-control input-lg" id="pwd" placeholder="Enter new password" required>
								</div>
							</div>


							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-info btn-lg" name="reset" type="submit" class="btn btn-default">Reset</button>
								</div>
							</div>
						</form>
						<h4><a href="login.php">Back</a></h4>
					</div>
					
			</div>
			<div class="col-md-1 col-sm-12"></div>
		</div>
	</div>

	<?php 
		if (isset($_POST['reset'])) {
			extract($_POST);

			$select="SELECT * FROM 6470users WHERE USERNAME='$user' AND PHONE='$phone';";
			$run=mysqli_query($conn,$select);
			if (mysqli_num_rows($run)==1) {
				$hashedPassword=password_hash($pass,PASSWORD_DEFAULT);
				$update="UPDATE 6470users SET PASSWORD_HASH='$hashedPassword' WHERE USERNAME='$user'";
				$query=mysqli_query($conn,$update);
				$_SESSION['user']=$user;
					// $_SESSION['phone']=$phone;
				$_SESSION['newuser']="false";
				$_SESSION['reset']="true";
				header("Location:dashboard.php");
				// die(mysqli_error($conn));
			}else{
				$_SESSION['user']=$user;
					// $_SESSION['phone']=$phone;
				$_SESSION['newuser']="false";
				header("Location:reset.php");

			}
		}
		// $_GET['reset']=1;
	 ?>

</body>
</html>
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
	.row{
		margin-top: 5em;
	}
	body{
		background-image: url("img/work.jpg");
		background-repeat: repeat;

	}
	.reset{
		background-color: ;
	}

</style>
</head>
<body>
	
	<div class="container-fluid">
		
		
		<!-- <h1 class="text-center"><span class="bg-info">TO</span><span class="bg-primary">DO</span></h1> -->
		<h1  class="text-center"><span class="text-success"><b>LOG</b></span>|<span class="text-primary">IN</span></h1>
		<div class="row">

			<div class="col-md-2 col-sm-12"></div>
			<div class="col-md-8 col-sm-12">
				<div class="jumbotron">
					
					<form class="form-horizontal" role="form" method="post" action="login.php">
						<div class="form-group">
							<label class="control-label col-sm-2 lead" for="user" >Username:</label>
							<div class="col-sm-10">
								<input type="user" name="user" class="form-control input-lg" id="user" placeholder="Enter username" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2 lead" for="pwd">Password:</label>
							<div class="col-sm-10">
								<input type="password" name="pass" class="form-control input-lg" id="pwd" placeholder="Enter password" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button class="btn btn-success btn-lg" type="submit" name="login" class="btn btn-default">Login</button>
							</div>
						</div>
					</form>
					<h4 class="text-right"><a href="reset.php">Forgot password?</a></h4>
					<h4  class="text-center"><a href="register.php">Are you new?Click here to register!</a></h4>
					
					<?php 
					if (isset($_POST['login'])) {
						extract($_POST);
						$select="SELECT * FROM 6470users WHERE USERNAME='$user'";
						$run=mysqli_query($conn,$select);

						if (!$row=mysqli_fetch_assoc($run)) {
							echo "<h2 class='text-center text-warning'>No such user</h2>";
							die();
						}
						if (!password_verify($pass,$row['PASSWORD_HASH'])) {
							$rid=1;
							echo "<h2 class='text-center text-danger'>Wrong password";
							
							echo "<a href='reset.php'>Click to reset password</a>";
							echo "</h2>";
							die();
						}else{
					// echo "<h2>Welcome back</h2>";
							$_SESSION['user']=$user;
					// $_SESSION['phone']=$phone;
							$_SESSION['newuser']="false";
							$_SESSION['reset']="false";
							header("Location:dashboard.php");
						}
					}

					?>
				</div>

			</div>
			<div class="col-md-2 col-sm-12"></div>
		</div>
		









	</div>	
	


</body>
</html>
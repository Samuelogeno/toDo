<?php session_start(); 
ob_start();
?>
<?php include("connection.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
	body{
		background-color: black;
		background-image: url("img/img5.jpg.jpg");
		background-repeat:repeat;
	}
	.tab-content{
		min-height: 30em;
	}
	.what{
		margin-top: 2em;
		margin-bottom: 1em;
	}
	.container-fluid{
		text-align: center;
		background-image: url("img/img5.jpg.jpg");
		background-repeat:repeat;
       	

	}

</style>
</head>
<body>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-11 col-sm-12">
				<?php 
				if ($_SESSION['newuser']=="true") {
					?>

					<h2 class="text-center text-success">You have signed up as <span class="text-info"><?php echo $_SESSION['user']; ?></span> Telephone:<span  class="text-info" ><?php echo $_SESSION['phone']; ?></span></h2>

					<?php
				}else{
					?>
					<h2 class="text-center text-success"><b>Welcome back</b> <span class="text-info"><b><?php echo $_SESSION['user']; ?></b></span></h2>
					<?php
				}

				?>
			</div>
			<div class="col-md-1 col-sm-5 text-right">
				<h2></h2>
				<form action="login.php" method="post">
					<input value="LOG OUT" type="submit" class="btn btn-danger" name="logout">
				</form>
				<?php 
				if (isset($_POST['logout'])) {
						// remove all session variables
					session_unset();

// destroy the session
					session_destroy();
					header("Location:login.php");
				}
				?>


			</div>
		</div>
		<div>
			<h3 class="text-left " style="color: black;">
				<?php 
				if ($_SESSION['reset']=="true") {
					echo "You successfully changed your password!!!";
				}
				?>
				
			</h3>
			<h3 class="text-left text-danger">
				<?php 
				if ($_SESSION['reset']=="failed") {
					echo " Password reset failed!!!";
				}
				?>
			</h3>
			
		</div>
		
	</div>
	<div class="container-fluid header">
		<div class="jumbotron">
			<h1 class="text-center"><span class="text-danger">TO</span>||<span>DO</span></h1>
			<div>
				
				<h2 class="text-warning"><?php echo date("l"); ?></h2>
				<h3 class=""><?php echo  date("Y/m/d"); ?></h3>
				<h3 class="bg-info">
					<?php 
					$user=$_SESSION['user'];
					$current=date('Y-m-d');
					$select="SELECT * FROM jobs WHERE username='$user' AND timeRemind='$current'";
					$table=mysqli_query($conn,$select);
					$no=mysqli_num_rows($table);
					echo "You have <b>".$no."</b> job(s) for today!!";
					?>
				</h3>
				<div>
					<?php 
					while ($row=mysqli_fetch_assoc($table)) {
						?>
						<div class="panel panel-primary lead">
							<div class="panel-heading"><?php echo $row['title']; ?></div>
							<div class="panel-body"><?php echo $row['description']; ?></div>
						</div>
						<?php
					}
					?>
				</div>
				
			</div><hr>

			<ul class="nav nav-pills lead">
				<li class="active"><a data-toggle="pill" href="#home">Home</a></li>
				<li><a data-toggle="pill" href="#menu1">View jobs</a></li>
				<li><a data-toggle="pill" href="#menu2">Add job</a></li>
				<li><a data-toggle="pill" href="#menu3">Edit job</a></li>
				<li><a class="text-danger" data-toggle="pill" href="#menu4">Delete job</a></li>
				<li><a data-toggle="pill" href="#menu5">Reset Password</a></li>

			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<h3 class="text-right bg-danger">
						<?php 
						$user=$_SESSION['user'];

						$select="SELECT * FROM jobs WHERE username='$user' ";
						$table=mysqli_query($conn,$select);
						$no=mysqli_num_rows($table);
						echo "You have a total of <b>".$no."</b> job(s)!!";
						?>
					</h3>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<?php 
							if (isset($_POST['edit'])) {
								extract($_POST);
								$select="SELECT * FROM jobs WHERE title='$selected'";
								$run=mysqli_query($conn,$select);
								$row=mysqli_fetch_assoc($run);
								?>
								<br><br><br><br>
								<h3><b>Current title:</b><?php echo $row['title']; ?></h3>
								<h3><b>Current description:</b><?php echo $row['description']; ?></h3>
								<h3><b>Scheduled for:</b><?php echo $row['timeRemind']; ?></h3>
								<?php
							}
							?>
						</div>
						<div class="col-md-6 col-sm-12">
							<?php 
							if (isset($_POST['edit'])) {
								extract($_POST);
								$_SESSION['changeTitle'] = $selected;


								if (!isset($title)) {
								# code...
									$title="";
								}
								?><form method="post" action="dashboard.php">
									<?php
									switch ($title) {
										case 'title':
										?>	
										<div class="form-group">
											<label><h4><b>New title:</b></h4>
												<input class="form-control input-lg" type="text" name="newtitle" placeholder="Enter new title">
											</label>

										</div>
										
										<?php
										break;

										default:
									# code...
										break;
									}
									if (!isset($description)) {
								# code...
										$description="";
									}
									switch ($description) {
										case 'description':
										?>
										<div class="form-group">
											<label><h4><b>New description</b></h4>
												<textarea name="newdescription" class="form-control"></textarea>
											</label>
										</div>
										<?php
										break;

										default:
									# code...
										break;
									}
									if (!isset($time)) {
								# code...
										$time="";
									}
									switch ($time) {
										case 'time':
										?>
										<div class="form-group">
											<label><h4><b>Day to do:</b></h4>
												<input class="form-control input-lg" type="date" name="newtime" >
											</label>
										</div>
										<?php
										break;

										default:
									# code...
										break;
									}

									?> <input type="submit" name="update" value="UPDATE" class="btn btn-success">
								</form>
								<?php
							}
							?>

						</div>
					</div>

					<?php 
					if (isset($_GET['del'])) {
						$delete="DELETE FROM jobs WHERE id='$_GET[del]'";
						$run=mysqli_query($conn,$delete);
						if ($run && mysqli_affected_rows($conn)==1) {
							echo "<h4 class=' text-success'>A job was deleted successfully!!</h4>";
						}else{

						}
					}
					?>
					<h3 class="what">What's on your mind <?php echo $_SESSION['user']; ?>?</h3>
					
					<form action="dashboard.php" method="post">
						<div class="row">
							<div class="col-md-5 col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control input-lg" name="searched" placeholder="Enter job title here" required>
									
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="submit" name="search" value="SEARCH" class="btn btn-lg btn-success">
							</div>
							
						</div>

					</form>
					<?php 
					if (isset($_POST['search'])) {
						$user=$_SESSION['user'];
						extract($_POST);
						$select = "SELECT * FROM jobs WHERE username = '$user' AND title='$searched'";
						$run = mysqli_query($conn,$select);
						if (mysqli_num_rows($run)==0) {
							?>
							<h2 class="text-danger">No job by that title</h2>
							<?php
						}
						while ($row = mysqli_fetch_assoc($run)) {
							$current=date('Y-m-d');
							$d1=strtotime($row['timeRemind']);
							$remainder=ceil(($d1-time())/60/60/24);
							
							
							?>
							<div class="panel panel-primary lead">
								<div class="panel-heading"><?php echo $row['title']; ?><span class="text-danger small">
									<?php 
									if ($row['timeRemind']<$current) {
										echo "<i>(Job no longer available)</i>";
									}
									?>
								</span></div>
								<div class="panel-body"><?php echo $row['description']; ?>
									<h4 class="text-right text-success"><?php 
									if ($remainder>=0) {
										echo $remainder." day(s) remaining";
									}
									?></h4>
									<h4 class="text-right">To do on : <?php echo $row['timeRemind']; ?></h4>
									
									<h4 class="text-right text-danger"><?php 
									$current=date('Y-m-d');
									if ($row['timeRemind']<$current) {
										echo "expired";										}

										?></h4>
									</div>
								</div>
								<?php
							}

						}
						?>

					</div>
					<div id="menu1" class="tab-pane fade">

						<?php 
						$user=$_SESSION['user'];
						$select = "SELECT * FROM jobs WHERE username = '$user'";
						$run = mysqli_query($conn,$select);
						while ($row = mysqli_fetch_assoc($run)) {
							$current=date('Y-m-d');
							$d1=strtotime($row['timeRemind']);
							$remainder=ceil(($d1-time())/60/60/24);
							?>
							<div class="panel panel-info lead">
								<div class="panel-heading"><?php echo $row['title'] ?><span class="text-danger small">
									<?php 
									if ($row['timeRemind']<$current) {
										echo "<i>(Job no longer available)</i>";
									}
									?>
								</span>
							</div>
							<div class="panel-body"><?php echo $row['description'] ?>
								<h4 class="text-right text-success"><?php 
								if ($remainder>=0) {
									echo $remainder." day(s) remaining";
								}
								?></h4>
							</div>
							<div class="panel-footer text-right ">To be done on: <?php echo $row['timeRemind'] ?><h4 class="text-right text-danger"><?php 
							$current=date('Y-m-d');
							if ($row['timeRemind'] < $current) {
								echo "expired";										}

								?></h4></div>
							</div><hr>
							<?php
						}
						if (mysqli_num_rows($run)==0) {
							?>
							<h2>You have no job to view.</h2>
							<?php
						}

						?>
					</div>
					<div id="menu2" class="tab-pane fade">
						<h2 class="text-center"><b>Write your plans <span class="glyphicon glyphicon-pencil"></span></b></h2>
						<h2></h2><br><br>
						<form method="post" action="dashboard.php">
							<div class="row">
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label>
											<h2>Job title:</h2><input placeholder="Job title" type="text" class="form-control input-lg" name="title" required>
										</label>
									</div>
								</div>
								<div class="col-md-4 col-sm-12">

									<div class="form-group">
										<label>
											<h2>Job description:</h2><textarea class="form-control input-lg bg-info" rows="5"   name="description" required></textarea>
										</label>
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label>
											<h2>Day to do:</h2><input type="date" class="form-control input-lg" name="time" required>
										</label>
									</div>
								</div>
							</div>


							<input class="btn btn-success btn-lg" type="submit" name="setreminder" value="SAVE TO DO">
						</form>
						<?php 
						if (isset($_POST['setreminder'])) {
							extract($_POST);
							$user=$_SESSION['user'];
							$insert = "INSERT INTO jobs(username,title,description,timeRemind) VALUES('$user','$title','$description','$time')";
							$run = mysqli_query($conn,$insert);
							if (!$run) {
								die("Failed".mysqli_error($conn));
									// header('Location:failed.php');
							}else{
								header('Location:dashboard.php');
							}
						}
						?>
					</div>
					<div id="menu3" class="tab-pane fade">
						<form action="dashboard.php" method="post">
							<div class="form-group">
								<h3 class="text-center"><b>Choose job by title</b></h3>
								<select name="selected" class="form-control input-lg" required>
									<option><i>Choose here</i></option>
									<?php 
									$user=$_SESSION['user'];
									$title="SELECT title FROM jobs WHERE username='$user'";
									$run=mysqli_query($conn,$title);
									while ($row=mysqli_fetch_assoc($run)) {
										echo "<option>";
										echo $row['title'];
										echo "</option>";
									}
									?>
								</select>
								<h3 class="text-center"><b>Select what to change</b></h3>
								<div class="checkbox lead ">
									<label><input name="title" type="checkbox" value="title">Job title</label>
								</div><br>
								<div class="checkbox  lead">
									<label><input name="description" type="checkbox" value="description">Job description</label>
								</div><br>
								<div class="checkbox  lead">
									<label><input name="time" type="checkbox" value="time" >Scheduled day</label>
								</div>
								<div class="text-center">
									<input  type="submit" name="edit" value="PROCEED" class="btn btn-success btn-lg">
								</div>
								
							</div><hr>
							
						</form>
					</div>
					<div id="menu4" class="tab-pane fade">
						<table class="table table-hover table-bordered lead">
							<thead>
								<tr>
									<th>Job title</th>
									<th>Job description</th>
									<th>Date to remind</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$user=$_SESSION['user'];
								$select="SELECT * FROM jobs WHERE username='$user'";
								$table=mysqli_query($conn,$select);
								while ($row = mysqli_fetch_assoc($table)) {
									$d1=strtotime($row['timeRemind']);
									$remainder=ceil(($d1-time())/60/60/24);
									$id=$row['id'];
									echo"<tr>";
									echo "<td>".$row['title']."</td>";
									echo "<td>".$row['description']."</td>";
									echo "<td>".$row['timeRemind']."</td>";
									if ($remainder>=0) {
										echo '<td class="text-success">Active</td>';
									}else{
										echo '<td class="text-danger">Expired</td>';
									}
									echo "<td ><a class='btn btn-danger' href='dashboard.php?del=$id'>DELETE</a></td>";
									echo "</tr>";
								}
								?>
							</tbody>
						</table>
					</div>
					<div id="menu5" class="tab-pane fade"><hr>
						<form class="form-horizontal" role="form" action="dashboard.php" method="post">
							<!-- <div class="form-group">
								<label class="control-label col-sm-2 lead" for="user"><b>Username:</b></label>
								<div class="col-sm-10">
									<input type="disabled" name="user" class="form-control input-lg" id="user" placeholder="Enter username" required>
								</div>
							</div> -->
							<div class="form-group">
								<label class="control-label col-sm-2 lead" for="pwd"><b>Password:</b></label>
								<div class="col-sm-10">
									<input type="password" name="currentpass" class="form-control input-lg" id="pwd" placeholder="Current password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2 lead" for="pwd"><b>New password:</b></label>
								<div class="col-sm-10">
									<input type="password" name="newpass" class="form-control input-lg" id="pwd" placeholder="New password" required>
								</div>
							</div>


							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-info btn-lg" name="reset" type="submit" class="btn btn-default">Reset</button>
								</div>
							</div>
						</form>
						
					</div>
				</div>

			</div>


		</div>
		<?php 
		if (isset($_POST['update'])) {
				// echo "string";
			extract($_POST);


			if (isset($newdescription)) {

				$current=$_SESSION['changeTitle'];
				$user=$_SESSION['user'];
				$description="UPDATE jobs SET description='$newdescription' WHERE username='$user' AND title='$current';";
				$descriptionrun=mysqli_query($conn,$description);
				if (!$descriptionrun) {
					die("error".mysqli_error($conn));
				}
			}
			if (isset($newtime)) {

				$current=$_SESSION['changeTitle'];
				$user=$_SESSION['user'];
				$time="UPDATE jobs SET timeRemind='$newtime' WHERE username='$user' AND title='$current';";
				$timerun=mysqli_query($conn,$time);
				if (!$timerun) {
					die("error".mysqli_error($conn));
				}
			}
			if (isset($newtitle)) {

				$current=$_SESSION['changeTitle'];
				$user=$_SESSION['user'];
				$title="UPDATE jobs SET title='$newtitle' WHERE username='$user' AND title='$current';";
				$titlerun=mysqli_query($conn,$title);
				if (!$titlerun) {
					die("error".mysqli_error($conn));
				}
			}
			header("Location:dashboard.php");
		}

		?>
		<?php 
						if (isset($_POST['reset'])) {
							extract($_POST);
							$user=$_SESSION['user'];
							$select="SELECT * FROM 6470users WHERE USERNAME='$user' ";
							$run=mysqli_query($conn,$select);
							$row=mysqli_fetch_assoc($run);
							if (!password_verify($currentpass,$row['PASSWORD_HASH'])) {
								$_SESSION['reset']="failed";
								header("Location:dashboard.php");
								
							}else{
								$hashedpassword=password_hash($newpass,PASSWORD_DEFAULT);
								$update="UPDATE 6470users SET PASSWORD_HASH='$hashedpassword' WHERE USERNAME='$user'";
								$query=mysqli_query($conn,$update);
								$_SESSION['reset']="true";
								header("Location:dashboard.php");
								// die(mysqli_error($conn));
							}
						}
						?>
		<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	</body>
	</html>
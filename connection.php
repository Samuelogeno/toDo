<?php 
	$servername="localhost";
	$username="root";
	$password="";
	$dbname="6470";
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if (!$conn) {
		die("Connection failed ".mysqli_error($conn));
	}
	else{
		// echo "Success";
	}

 ?>
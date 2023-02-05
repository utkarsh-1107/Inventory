<?php
	session_start();
	$response["v"] = "1";
	include_once("../includes/db_con.php");
	if(isset($_POST["name"]) && isset($_POST["location"]) && isset($_POST["stock"])){
		$username = $_SESSION["username"];
		$name = mysqli_real_escape_string($con, $_POST["name"]);
		$location = mysqli_real_escape_string($con, $_POST["location"]);
		$stock = mysqli_real_escape_string($con, $_POST["stock"]);
		$date_time = mysqli_real_escape_string($con, $_POST["date"]);

		$sql = "INSERT INTO events(name,location,stock,username,date_time) VALUES('$name','$location','$stock','$username','$date_time')";
	
		if(mysqli_query($con, $sql)){
			$response["status"] = "ok";
		} else {
			$response["status"] = "error";
			$response["msg"] = "Something went wrong. Please try again.";
		}
	} else {
		$response["status"] = "error";
		$response["msg"] = "Something went wrong. Please try again.";
	}
	echo json_encode($response);
?>
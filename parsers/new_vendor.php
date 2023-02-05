<?php
	session_start();
	$response["v"] = "1";
	include_once("../includes/db_con.php");
	if(isset($_POST["name"]) && isset($_POST["location"]) && isset($_POST["units"])){
		$username = $_SESSION["username"];
		$name = mysqli_real_escape_string($con, $_POST["name"]);
		$location = mysqli_real_escape_string($con, $_POST["location"]);
		$units = mysqli_real_escape_string($con, $_POST["units"]);

		$sql = "INSERT INTO distributions(name,location,units,username) VALUES('$name','$location','$units','$username')";
	
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
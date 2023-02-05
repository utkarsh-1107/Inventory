<?php
	session_start();
	$response["v"] = "1";
	include_once("../includes/db_con.php");
	if(isset($_POST["units"]) && isset($_POST["sales"]) && isset($_POST["unitsLeft"])){
		$username = $_SESSION["username"];
		$units = mysqli_real_escape_string($con, $_POST["units"]);
		$sales = mysqli_real_escape_string($con, $_POST["sales"]);
		$unitsLeft = mysqli_real_escape_string($con, $_POST["unitsLeft"]);

		$sql = "INSERT INTO sales(units,sales,units_left,username) VALUES('$units','$sales','$unitsLeft','$username')";
	
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
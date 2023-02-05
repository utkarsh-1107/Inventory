<?php
	session_start();
	$response["v"] = "1";
	include_once("../includes/db_con.php");
	if(isset($_POST["password"])){
		$username = $_SESSION["username"];
		$password = md5(mysqli_real_escape_string($con, $_POST["password"]));
		$sql = "UPDATE users SET password='$password' WHERE username='$username' LIMIT 1";
		if(mysqli_query($con, $sql)){
			$response["status"] = "ok";
		} else {
			$response["status"] = "error";
			$response["msg"] = "Something went wrong";
		}
	} else {
		$response["status"] = "error";
		$response["msg"] = "Something went wrong";
	}
	echo json_encode($response);
?>
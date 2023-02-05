<?php
	session_start();
	$response["v"] = "1";
	include_once("../../includes/db_con.php");
	if(isset($_POST["id"]) && isset($_POST["type"])){
		$id = mysqli_real_escape_string($con, $_POST["id"]);
		$type = mysqli_real_escape_string($con, $_POST["type"]);
		$sql = "UPDATE sales SET status='$type' WHERE id='$id' LIMIT 1";
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
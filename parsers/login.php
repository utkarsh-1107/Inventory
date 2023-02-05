<?php
	session_start();
	$response["v"] = "1";
	include_once("../includes/db_con.php");
	if(isset($_POST["name"]) && isset($_POST["password"])){
		$username = mysqli_real_escape_string($con, $_POST["name"]);
		$password = md5(mysqli_real_escape_string($con, $_POST["password"]));
		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$res = mysqli_query($con, $sql);
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_array($res);
			$_SESSION["username"] = $username;
			$response["status"] = "ok";
		} else {
			$response["status"] = "error";
			$response["msg"] = "Invalid Credentials";
		}
	} else {
		$response["status"] = "error";
		$response["msg"] = "Invalid Credentials";
	}
	echo json_encode($response);
?>
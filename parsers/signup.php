<?php
	session_start();
	$response["v"] = "1";
	include_once("../includes/db_con.php");
	
	if(isset($_POST["fullname"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){
		$fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
		$username = mysqli_real_escape_string($con, $_POST["name"]);
		$email = mysqli_real_escape_string($con, $_POST["email"]);
		$password = mysqli_real_escape_string($con, $_POST["password"]);
		$city = mysqli_real_escape_string($con, $_POST["city"]);
		
		$password = md5($password);



		$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$res = mysqli_query($con, $sql);
		if(mysqli_num_rows($res) > 0){
			$response["status"] = "error";
			$response["msg"] = "Username already exist.";
		} else {
			$sql = "INSERT INTO users(fullname,username,city,email,password) VALUES('$fullname','$username','$city','$email','$password')";
			$res = mysqli_query($con, $sql);
			if($res) {
				$_SESSION["username"] = $username;
				$response["status"] = "ok";
			}
		}
	} else {
		$response["status"] = "error";
		$response["msg"] = "Provide valid fullname/email/password";
	}
	echo json_encode($response);
?>
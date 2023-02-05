<?php
	session_start();
	if(isset($_SESSION["username"])){
		header("Location: dashboard.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include_once("views/header.php"); ?>
	<div class="hero">
		Create an account
	</div>
	<div class="form" id="signup-form">
		<div>
			<label for="user-fullname">Fullname</label>
			<input type="text" id="user-fullname" maxlength="20">
		</div>
		<div>
			<label for="user-name">Username</label>
			<input type="text" id="user-name" maxlength="15">
		</div>
		<div>
			<label for="user-email">Email</label>
			<input type="text" id="user-email" maxlength="20">
		</div>
		<div>
			<label for="user-password">Password</label>
			<input type="password" id="user-password" maxlength="20">
		</div>
		<div>
			<label for="user-city">City</label>
			<input type="text" id="user-city" maxlength="20">
		</div>
		<div>
			<button id="signup-btn">Signup</button>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/code.js"></script>
	<script type="text/javascript">
		
		_("#signup-btn").addEventListener("click", function(event){
			let user = {
				fullname:_("#signup-form #user-fullname").value.trim(),
				name:_("#signup-form #user-name").value.trim(),
				city:_("#signup-form #user-city").value.trim(),
				email:_("#signup-form #user-email").value.trim(),
				password:_("#signup-form #user-password").value
			};
			if(user.fullname.length < 2){
				alert("Enter valid full name");
				return;
			} if(user.name.length < 2){
				alert("Enter valid username");
				return;
			} else if(!validateEmail(user.email)){
				alert("Enter valid email address");
				return;
			} else if(user.password.length < 6){
				alert("Enter valid credentials");
				return;
			}
			ajax({
				url:"parsers/signup.php",
				type:"POST",
				data:user,
				callback:function(data){
					let response = JSON.parse(data);
					if(response.status == "ok"){
						swal("Signup successful!","", "success").then(function(){
							window.location.assign("dashboard.php");
						});
					} else {
						alert(response.message);
					}
				},
				error:function(){
					alert("Someting went wrong. Please try again.");
				}
			})
		});
	</script>
</body>
</html>


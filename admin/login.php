<?php
	session_start();
	if(isset($_SESSION["admin"])){
		header("Location: dashboard.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
<html>
<head>
	<title>Admin Login</title>
</head>
<body>
	<div class="hero hero-admin">
		Admin Login
	</div>
	<div class="form" id="login-form">
		<div>
			<label for="user-name">Username</label>
			<input type="text" id="user-name">
		</div>
		<div>
			<label for="user-password">Password</label>
			<input type="password" id="user-password">
		</div>
		<div>
			<button id="login-btn">Login</button>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="../js/code.js"></script>
	<script type="text/javascript">
		
		_("#login-btn").addEventListener("click", function(event){
			let user = {
				name:_("#login-form #user-name").value,
				password:_("#login-form #user-password").value
			};
			if(user.name.length < 2){
				alert("Enter valid name address");
				return;
			} else if(user.password.length < 6){
				alert("Enter valid credentials");
				return;
			}
			ajax({
				url:"parsers/login.php",
				type:"POST",
				data:user,
				callback:function(data){
					let response = JSON.parse(data);
					if(response.status == "ok"){
						window.location.assign("dashboard.php");
					} else {
						alert(response.msg);
					}
				},
				error:function(){
					
				}
			})
		});
	</script>
</body>
</html>
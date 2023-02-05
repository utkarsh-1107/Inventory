<div class="hero hero-sm">
	Update Password
</div>

<div class="form" id="update-password-form">
	<div>
		<label for="user-password">Password</label>
		<input type="password" id="user-password">
	</div>
	<div>
		<label for="user-password-2">Confirm password</label>
		<input type="password" id="user-password-2">
	</div>
	<div>
		<button id="user-password-btn">Update</button>
	</div>
</div>

<script type="text/javascript" src="js/code.js"></script>

<script type="text/javascript">
	_("#user-password-btn").addEventListener("click", function(event){
		let user = {
			password:_("#update-password-form #user-password").value,
			password2:_("#update-password-form #user-password-2").value,
		};
		if(user.password.length < 6){
			alert("Enter valid password");
			return;
		} else if(user.password != user.password2){
			alert("Confirm password do not match");
			return;
		}
		ajax({
			url:"parsers/update_password.php",
			type:"POST",
			data:user,
			callback:function(data){
				let response = JSON.parse(data);
				if(response.status == "ok"){
					swal("Password updated successfully");
					_("#update-password-form #user-password").value = "";
					_("#update-password-form #user-password-2").value = "";
				} else {
					alert(response.msg);
				}
			},
			error:function(){
				
			}
		})
	});	
</script>
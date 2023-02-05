<div class="nav">
	<a class="logo" href="dashboard.php">LOGO</a>
	<div class="links">
		<?php if (!isset($_SESSION["username"])) { ?>		
			<a href="signup.php">Signup</a>
			<a href="login.php">Login</a>
		<?php } else { ?>					
			<a href="dashboard.php">Home</a>
			<a href="dashboard.php?tab=5">Update Password</a>
			<a href="logout.php">Logout</a>
		<?php } ?>			
	</div>
</div>


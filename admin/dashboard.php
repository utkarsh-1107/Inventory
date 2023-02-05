<?php
	session_start();
	if(!isset($_SESSION["admin"])){
		header("Location: login.php");
	}
	include_once("../includes/db_con.php");

	$tab = "1";
	if(isset($_GET["tab"])){
		$tab = $_GET["tab"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="dashboard.php">Logo</a>
	    </div>
	    <ul class="nav navbar-nav navbar-right">
	      <li id="tab_1"><a href="dashboard.php?tab=1">Users</a></li>
	      <li id="tab_2"><a href="dashboard.php?tab=2">Event</a></li>
	      <li id="tab_3"><a href="dashboard.php?tab=3">Distribution</a></li>
	      <li id="tab_4"><a href="dashboard.php?tab=4">Report</a></li>
	      <li><a href="logout.php">Logout</a></li>
	    </ul>
	  </div>
	</nav>	

	<div style="margin-top:80px;"></div>
	<div class="container">
		<div class="row">
			
			<?php
				if($tab == "2"){
					include_once("views/events.php");
				} else if($tab == "3"){
					include_once("views/distribution.php");
				} else if($tab == "4"){
					include_once("views/report.php");
				} else {
					include_once("views/users.php");
				}

			?>

		</div>
	</div>

	<script type="text/javascript">
		let activeTab = "tab_<?php echo $tab;?>";
		document.getElementById(activeTab).classList.add("active");
	</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
</body>
</html>
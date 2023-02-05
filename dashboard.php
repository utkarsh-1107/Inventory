<?php
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
	}
	$username = $_SESSION["username"];

	$tab = 0;
	if(isset($_GET["tab"])){
		$tab = $_GET["tab"];
	}

	include_once("includes/db_con.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include_once("views/header.php"); ?>
	<div id="sidebar">
		<div class="links">
			<a href="dashboard.php?tab=1" id="tab_1">
				<i class="fa fa-plus"></i>
				New Event
			</a>
			<a href="dashboard.php?tab=2" id="tab_2">
				<i class="fa fa-users"></i>
				Distribution
			</a>
			<a href="dashboard.php?tab=3" id="tab_3">
				<i class="fa fa-table"></i>
				Event Report
			</a>
			<a href="dashboard.php?tab=4" id="tab_4">
				<i class="fa fa-history"></i>
				History
			</a>
		</div>
	</div>
	<div class="frame-data">
		<?php
			if($tab == "1"){
				include_once("views/new_event.php");
			} else if($tab == "2"){
				include_once("views/distribution.php");
			} else if($tab == "3"){
				include_once("views/event_report.php");
			} else if($tab == "4"){
				include_once("views/history.php");
			} else if($tab == "5"){
				include_once("views/update_password.php");
			} else {
				include_once("views/home.php");
			}

		?>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		let activeTab = "tab_<?php echo $tab;?>";
		document.getElementById(activeTab).classList.add("active");
	</script>
</body>
</html>
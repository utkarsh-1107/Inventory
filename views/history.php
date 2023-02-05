<?php
	$event_sql = "SELECT * FROM events WHERE username='$username'";
	$event_res = mysqli_query($con, $event_sql);

	$distributions_sql = "SELECT * FROM distributions WHERE username='$username'";
	$distributions_res = mysqli_query($con, $distributions_sql);

	$sales_sql = "SELECT * FROM sales WHERE username='$username'";
	$sales_res = mysqli_query($con, $sales_sql);
?>

<div class="hero hero-sm">
	History
</div>
<div class="tabs">
	<div class="tab-header">
		<div class="active">Events</div>
		<div>Distributions</div>
		<div>Report</div>
	</div>
	<div class="tab-body">
		<div class="active">
			<table>
				<tr>
					<th>id</th>
					<th>Event name</th>
					<th>Location</th>
					<th>Stock</th>
					<th>Date</th>
					<th>Status</th>
				</tr>
				<?php while($row = mysqli_fetch_array($event_res)) { ?>
					<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["location"]; ?></td>
						<td><?php echo $row["stock"]; ?></td>
						<td><?php echo $row["date_time"]; ?></td>
						<td><?php 
							if($row["status"] == "p"){
								echo "Pending";
							} else if ($row["status"] == "a"){
								echo "Approved";
							} else {
								echo "Rejected";
							}
						?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div>
			<table>
				<tr>
					<th>id</th>
					<th>Event name</th>
					<th>Location</th>
					<th>Units</th>
					<th>Status</th>
				</tr>
				<?php while($row = mysqli_fetch_array($distributions_res)) { ?>
					<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["location"]; ?></td>
						<td><?php echo $row["units"]; ?></td>
						<td><?php
							if($row["status"] == "p"){
								echo "Pending";
							} else if ($row["status"] == "a"){
								echo "Approved";
							} else {
								echo "Rejected";
							}
						?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div>
			<table>
				<tr>
					<th>id</th>
					<th>Units</th>
					<th>Sales</th>
					<th>Units left</th>
					<th>Status</th>
				</tr>
				<?php while($row = mysqli_fetch_array($sales_res)) { ?>
					<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["units"]; ?></td>
						<td><?php echo $row["sales"]; ?></td>
						<td><?php echo $row["units_left"]; ?></td>
						<td><?php
							if($row["status"] == "p"){
								echo "Pending";
							} else if ($row["status"] == "a"){
								echo "Approved";
							} else {
								echo "Rejected";
							}
						?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	let tabs = document.querySelector(".tabs");
	let tabHeader = tabs.querySelector(".tab-header");
	let tabHeaderElements = tabs.querySelectorAll(".tab-header > div");
	let tabBody = tabs.querySelector(".tab-body");
	let tabBodyElements = tabs.querySelectorAll(".tab-body > div");

	for(let i=0;i<tabHeaderElements.length;i++){
		tabHeaderElements[i].addEventListener("click",function(){
			tabHeader.querySelector(".active").classList.remove("active");
			tabHeaderElements[i].classList.add("active");
			tabBody.querySelector(".active").classList.remove("active");
			tabBodyElements[i].classList.add("active");
		});
	}
</script>
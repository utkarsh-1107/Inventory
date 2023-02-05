<div class="hero hero-sm">
	Event Report
</div>
<div class="form" id="report-form">
	<div>
		<label for="report-units">Units</label>
		<input type="number" id="report-units" min="1" value="1">
	</div>
	<div>
		<label for="report-sales">Sales</label>
		<input type="number" id="report-sales" min="1" value="1">
	</div>
	<div>
		<label for="report-units-left">Units left</label>
		<input type="number" id="report-units-left" min="1" value="1">
	</div>
	<div>
		<button id="report-add-btn">Add</button>
	</div>
</div>

<script type="text/javascript" src="js/code.js"></script>

<script type="text/javascript">
	_("#report-add-btn").addEventListener("click", function(event){
		let report = {
			units:+_("#report-form #report-units").value,
			sales:+_("#report-form #report-sales").value,
			unitsLeft:+_("#report-form #report-units-left").value,
		};
		if(report.units < 1){
			alert("Enter valid units");
			return;
		} else if(report.sales < 1){
			alert("Enter valid sales");
			return;
		} else if(report.unitsLeft < 0){
			alert("Enter valid units left");
			return;
		}
		ajax({
			url:"parsers/new_report.php",
			type:"POST",
			data:report,
			callback:function(data){
				let response = JSON.parse(data);
				if(response.status == "ok"){
					swal("Created new report successfully","Pending for admin approval", "success").then(function(){
						window.location.assign("dashboard.php?tab=3");
					});
				} else {
					alert(response.msg);
				}
			},
			error:function(){
				alert("Something went wrong. Please try again");
			}
		})
	});
</script>
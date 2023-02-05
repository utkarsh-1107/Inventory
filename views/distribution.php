<div class="hero hero-sm">
	Add Distribution
</div>
<div class="form" id="vendor-form">
	<div>
		<label for="vendor-name">Vendor name</label>
		<select id="vendor-name">
			<option id="Vendor 1">Vendor 1</option>
			<option id="Vendor 2">Vendor 2</option>
			<option id="Vendor 3">Vendor 3</option>
			<option id="Vendor 4">Vendor 4</option>
			<option id="Vendor 5">Vendor 5</option>
		</select>
	</div>
	<div>
		<label for="vendor-units">Stock</label>
		<input type="number" id="vendor-units" min="1" value="1">
	</div>
	<div>
		<label for="vendor-location">Location</label>
		<input type="text" id="vendor-location">
	</div>
	
	<div>
		<button id="vendor-add-btn">Add</button>
	</div>
</div>

<script type="text/javascript" src="js/code.js"></script>

<script type="text/javascript">
	_("#vendor-add-btn").addEventListener("click", function(event){
		let vendor = {
			name:_("#vendor-form #vendor-name").value,
			location:_("#vendor-form #vendor-location").value,
			units:+_("#vendor-form #vendor-units").value
		};
		if(vendor.name.length < 2){
			alert("Enter valid event name");
			return;
		} else if(vendor.location.length < 2){
			alert("Enter valid event location");
			return;
		} else if(vendor.units < 0){
			alert("Enter valid units");
			return;
		}
		ajax({
			url:"parsers/new_vendor.php",
			type:"POST",
			data:vendor,
			callback:function(data){
				let response = JSON.parse(data);
				if(response.status == "ok"){
					swal("Created new distribution successfully","Pending for admin approval", "success").then(function(){
						window.location.assign("dashboard.php?tab=2");
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
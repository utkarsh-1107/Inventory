<div class="hero hero-sm">
	New Event
</div>
<div class="form" id="event-form">
	<div>
		<label for="event-name">Event name</label>
		<input type="text" id="event-name">
	</div>
	<div>
		<label for="event-location">Location</label>
		<input type="text" id="event-location">
	</div>
	<div>
		<label for="event-date">Date</label>
		<input type="date" id="event-date">
	</div>
	<div>
		<label for="event-stock">Stock</label>
		<input type="number" id="event-stock" min="1" value="1">
	</div>
	<div>
		<button id="event-add-btn">Add</button>
	</div>
</div>

<script type="text/javascript" src="js/code.js"></script>

<script type="text/javascript">
	_("#event-add-btn").addEventListener("click", function(event){
		let myevent = {
			name:_("#event-form #event-name").value,
			location:_("#event-form #event-location").value,
			date:_("#event-form #event-date").value,
			stock:+_("#event-form #event-stock").value
		};
		if(myevent.name.length < 2){
			alert("Enter valid event name");
			return;
		} else if(myevent.location.length < 2){
			alert("Enter valid event location");
			return;
		} else if(myevent.date < 0){
			alert("Enter valid date");
			return;
		} else if(myevent.date < 0){
			alert("Enter valid stock");
			return;
		}
		ajax({
			url:"parsers/new_event.php",
			type:"POST",
			data:myevent,
			callback:function(data){
				let response = JSON.parse(data);
				if(response.status == "ok"){
					swal("Created new event successfully","Pending for admin approval", "success").then(function(){
						window.location.assign("dashboard.php?tab=1");
					});
				} else {
					alert(response.msg);
				}
			},
			error:function(){
				
			}
		})
	});
</script>
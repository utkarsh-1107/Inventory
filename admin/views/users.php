<?php
	$all_users_sql = "SELECT * FROM users";
  	$users_res = mysqli_query($con, $all_users_sql);
?>

<div class="jumbotron">
  <h1>User Details</h1>
</div>
<br>
<div class="container">
	<div class="row">	
	    <table class="table table-striped">
	        <thead>
	          <tr>
	            <th>id</th>
	            <th>Fullname</th>
	            <th>Username</th>
	            <th>Email</th>
	            <th>City</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php while($row = mysqli_fetch_array($users_res)) { ?>
	              <tr>
	                <td><?php echo $row["id"]; ?></td>
	                <td><?php echo $row["fullname"]; ?></td>
	                <td><?php echo $row["username"]; ?></td>
	                <td><?php echo $row["email"]; ?></td>
	                <td><?php echo $row["city"]; ?></td>
	          <?php } ?>
	        </tbody>
	    </table>		
	</div>
</div>
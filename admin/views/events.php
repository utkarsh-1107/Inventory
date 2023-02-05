<?php
  $all_event_sql = "SELECT * FROM events";
  $all_event_res = mysqli_query($con, $all_event_sql);

  $pending_event_sql = "SELECT * FROM events WHERE status='p'";
  $pending_event_res = mysqli_query($con, $pending_event_sql);

  $approved_event_sql = "SELECT * FROM events WHERE status='a'";
  $approved_event_res = mysqli_query($con, $approved_event_sql);

  $disapproved_event_sql = "SELECT * FROM events WHERE status='d'";
  $disapproved_event_res = mysqli_query($con, $disapproved_event_sql);
?>

<div class="jumbotron">
  <h1>Events</h1>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#all">All</a></li>
  <li><a data-toggle="tab" href="#pending">Pending</a></li>
  <li><a data-toggle="tab" href="#approved">Approved</a></li>
  <li><a data-toggle="tab" href="#disapproved">Disappoved</a></li>
</ul>
<br>
<div class="tab-content">
  <div id="all" class="tab-pane fade in active">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Location</th>
            <th>Date</th>
            <th>Stock</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($all_event_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["date_time"]; ?></td>
                <td><?php echo $row["stock"]; ?></td>
                <td><?php if($row["status"] == "p"){
                    echo "Pending";
                  } else if ($row["status"] == "a"){
                    echo "Approved";
                  } else {
                    echo "Rejected";
                  } ?>
                </td>
              </tr>
          <?php } ?>

        </tbody>
    </table>
  </div>
  <div id="pending" class="tab-pane fade">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Location</th>
            <th>Stock</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($pending_event_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["stock"]; ?></td>
                <td><?php echo $row["date_time"]; ?></td>
                <td>
                  <button class="btn btn-primary" onclick="updateState(<?php echo $row['id'];?>,'a')">Approve</button>
                  <button class="btn btn-danger" onclick="updateState(<?php echo $row['id'];?>,'d')">Disapprove</button>
                </td>
              </tr>
          <?php } ?>

        </tbody>
    </table>
  </div>
  <div id="approved" class="tab-pane fade">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Location</th>
            <th>Stock</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($approved_event_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["stock"]; ?></td>
                <td><?php echo $row["date_time"]; ?></td>
              </tr>
          <?php } ?>

        </tbody>
    </table>
  </div>
  <div id="disapproved" class="tab-pane fade">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Location</th>
            <th>Stock</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($disapproved_event_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["stock"]; ?></td>
                <td><?php echo $row["date_time"]; ?></td>
              </tr>
          <?php } ?>

        </tbody>
    </table>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="../js/code.js"></script>

<script type="text/javascript">
  function updateState(id,type){
      let data = {
          id:id,
          type:type
      };
      ajax({
        url:"parsers/event_state_update.php",
        type:"POST",
        data:data,
        callback:function(data){
          let response = JSON.parse(data);
          if(response.status == "ok"){
            swal("Event status updated successfully").then(function(){
              window.location.assign("dashboard.php?tab=2");
            });
          } else {
            alert(response.msg);
          }
        },
        error:function(){
          
        }
      })
  }
</script>
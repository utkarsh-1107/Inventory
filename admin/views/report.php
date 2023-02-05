<?php
  $all_sale_sql = "SELECT * FROM sales";
  $all_sale_res = mysqli_query($con, $all_sale_sql);

  $pending_sale_sql = "SELECT * FROM sales WHERE status='p'";
  $pending_sale_res = mysqli_query($con, $pending_sale_sql);

  $approved_sale_sql = "SELECT * FROM sales WHERE status='a'";
  $approved_sale_res = mysqli_query($con, $approved_sale_sql);

  $disapproved_sale_sql = "SELECT * FROM sales WHERE status='d'";
  $disapproved_sale_res = mysqli_query($con, $disapproved_sale_sql);
?>

<div class="jumbotron">
  <h1>Sales</h1>
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
            <th>Units</th>
            <th>Sales</th>
            <th>Units left</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($all_sale_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["units"]; ?></td>
                <td><?php echo $row["sales"]; ?></td>
                <td><?php echo $row["units_left"]; ?></td>
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
            <th>Units</th>
            <th>Sales</th>
            <th>Units left</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($pending_sale_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["units"]; ?></td>
                <td><?php echo $row["sales"]; ?></td>
                <td><?php echo $row["units_left"]; ?></td>
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
            <th>Units</th>
            <th>Sales</th>
            <th>Units left</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($approved_sale_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["units"]; ?></td>
                <td><?php echo $row["sales"]; ?></td>
                <td><?php echo $row["units_left"]; ?></td>
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
            <th>Units</th>
            <th>Sales</th>
            <th>Units left</th>
          </tr>
        </thead>
        <tbody>

          <?php while($row = mysqli_fetch_array($disapproved_sale_res)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["units"]; ?></td>
                <td><?php echo $row["sales"]; ?></td>
                <td><?php echo $row["units_left"]; ?></td>
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
        url:"parsers/sale_state_update.php",
        type:"POST",
        data:data,
        callback:function(data){
          let response = JSON.parse(data);
          if(response.status == "ok"){
            swal("Sales status updated successfully").then(function(){
              window.location.assign("dashboard.php?tab=4");
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